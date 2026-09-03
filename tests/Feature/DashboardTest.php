<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_view_patient_dashboard(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_medical_staff_can_view_staff_dashboard(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);

        $response = $this->actingAs($staff)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_medical_staff_can_see_patients_list(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($staff)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee($patient->full_name);
    }

    public function test_medical_staff_can_update_patient_health_status(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create([
            'account_type' => 'patient',
            'health_status' => 'healthy',
        ]);

        $response = $this->actingAs($staff)->patchJson("/patients/{$patient->id}/status", [
            'health_status' => 'patient',
        ]);

        $response->assertRedirect();
        $patient->refresh();
        $this->assertEquals('patient', $patient->health_status);
    }

    public function test_medical_staff_can_mark_patient_as_healthy(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create([
            'account_type' => 'patient',
            'health_status' => 'patient',
        ]);

        $response = $this->actingAs($staff)->patchJson("/patients/{$patient->id}/status", [
            'health_status' => 'healthy',
        ]);

        $response->assertRedirect();
        $patient->refresh();
        $this->assertEquals('healthy', $patient->health_status);
    }

    public function test_patient_cannot_update_health_status(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);
        $anotherPatient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->patchJson("/patients/{$anotherPatient->id}/status", [
            'health_status' => 'patient',
        ]);

        $response->assertStatus(403);
    }

    public function test_health_status_must_be_valid_value(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($staff)->patchJson("/patients/{$patient->id}/status", [
            'health_status' => 'invalid_status',
        ]);

        $response->assertStatus(422);
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_staff_dashboard_shows_reports_tab(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);

        $response = $this->actingAs($staff)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Medical Reports Feed');
    }
}
