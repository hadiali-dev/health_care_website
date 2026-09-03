<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the appropriate dashboard based on user role.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->account_type === 'medical_staff') {
            // Fetch patients for the staff dashboard
            $patients = User::where('account_type', 'patient')
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

            // Fetch reports for the Reports tab
            $reports = Report::with('user')->latest()->paginate(15);

            return view('dashboard.staff', compact('patients', 'reports'));
        }

        // Patient dashboard
        return view('dashboard.patient');
    }

    /**
     * Medical Staff: Update a patient's health status.
     */
    public function updateHealthStatus(Request $request, User $patient)
    {
        // Security check: Only medical staff can do this
        if ($request->user()->account_type !== 'medical_staff') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'health_status' => 'required|in:healthy,patient'
        ]);

        $patient->update([
            'health_status' => $request->health_status
        ]);

        // Redirect back to the dashboard with a success message
        return back()->with('success', 'Patient status updated successfully!');
    }
}