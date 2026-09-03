<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Get nearby patients based on provided coordinates.
     * (Accessed via AJAX/Fetch API from the frontend).
     */
    public function getNearby(Request $request)
    {
        // Security: Only patients can access this feature
        if ($request->user()->account_type !== 'patient') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $lat = (float) $request->latitude;
        $lng = (float) $request->longitude;
        $user = $request->user();

        // 1. Update the current user's location
        $user->update([
            'latitude' => $lat,
            'longitude' => $lng,
            'location_updated_at' => now(),
        ]);

        // 2. Calculate distance using Haversine formula (Meters) - SQLite compatible
        $haversine = "(
            6371000 * acos(
                cos(radians(?)) * cos(radians(latitude)) * 
                cos(radians(longitude) - radians(?)) + 
                sin(radians(?)) * sin(radians(latitude))
            )
        )";

        // 3. Find only patients who are sick, within 200m, excluding the current user
        // Use WHERE instead of HAVING for SQLite compatibility
        $nearby = User::select('id', 'full_name', 'latitude', 'longitude')
            ->selectRaw("{$haversine} AS distance", [$lat, $lng, $lat])
            ->where('account_type', 'patient')
            ->where('health_status', 'patient')
            ->where('id', '!=', $user->id)
            ->whereRaw("{$haversine} <= 200", [$lat, $lng, $lat])
            ->orderBy('distance')
            ->get();

        return response()->json([
            'status' => 'success',
            'nearby_patients' => $nearby
        ]);
    }
}