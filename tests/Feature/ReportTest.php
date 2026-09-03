<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_submit_report(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->post('/reports', [
            'report_text' => 'I am feeling unwell with headache and fever.',
        ]);

        $this->assertDatabaseHas('reports', [
            'user_id' => $patient->id,
            'report_text' => 'I am feeling unwell with headache and fever.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_patient_cannot_submit_empty_report(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->post('/reports', [
            'report_text' => '',
        ]);

        $response->assertSessionHasErrors('report_text');
    }

    public function test_medical_staff_cannot_submit_report(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);

        $response = $this->actingAs($staff)->post('/reports', [
            'report_text' => 'This should fail.',
        ]);

        $response->assertStatus(403);
    }

    public function test_medical_staff_can_view_reports(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create(['account_type' => 'patient']);
        Report::factory()->create(['user_id' => $patient->id]);

        $response = $this->actingAs($staff)->get('/reports');

        $response->assertStatus(200);
        $response->assertSee($patient->full_name);
    }

    public function test_patient_cannot_view_reports(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->get('/reports');

        $response->assertStatus(403);
    }

    public function test_medical_staff_can_delete_report(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create(['account_type' => 'patient']);
        $report = Report::factory()->create(['user_id' => $patient->id]);

        $response = $this->actingAs($staff)->delete("/reports/{$report->id}");

        $this->assertSoftDeleted('reports', ['id' => $report->id]);
        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_patient_cannot_delete_report(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);
        $report = Report::factory()->create(['user_id' => $patient->id]);

        $response = $this->actingAs($patient)->delete("/reports/{$report->id}");

        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_reports(): void
    {
        $response = $this->get('/reports');

        $response->assertRedirect('/login');
    }
}
