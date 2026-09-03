<?php


namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Medical Staff Only: View all reports.
     */
    public function index(Request $request)
    {
        if ($request->user()->account_type !== 'medical_staff') {
            abort(403, 'Unauthorized action.');
        }

        // Fetch reports with the patient data, newest first
        $reports = Report::with('user')->latest()->paginate(15);

        return view('reports.index', compact('reports'));
    }

    /**
     * Patient Only: Submit a new report.
     */
    public function store(Request $request)
    {
        if ($request->user()->account_type !== 'patient') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'report_text' => 'required|string|max:5000',
        ]);

        Report::create([
            'user_id' => $request->user()->id,
            'report_text' => $request->report_text,
        ]);

        return back()->with('success', 'Your report has been sent securely to the medical staff.');
    }

    /**
     * Medical Staff Only: Delete a report.
     */
    public function destroy(Request $request, Report $report)
    {
        if ($request->user()->account_type !== 'medical_staff') {
            abort(403, 'Unauthorized action.');
        }

        $report->delete();

        return back()->with('success', 'Report deleted successfully.');
    }
}   