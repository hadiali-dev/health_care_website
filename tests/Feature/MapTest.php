<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_update_location(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertJson(['status' => 'success']);

        $patient->refresh();
        $this->assertEquals(33.51380, $patient->latitude);
        $this->assertEquals(36.27650, $patient->longitude);
    }

    public function test_patient_can_find_nearby_sick_patients(): void
    {
        // Current user (patient) in Damascus
        $currentPatient = User::factory()->create([
            'account_type' => 'patient',
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        // Sick patient nearby (within 200m - roughly 0.002 degrees)
        $nearbySickPatient = User::factory()->create([
            'account_type' => 'patient',
            'health_status' => 'patient',
            'latitude' => 33.51400,
            'longitude' => 36.27660,
        ]);

        $response = $this->actingAs($currentPatient)->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertJson(['status' => 'success']);
        $data = $response->json();
        $this->assertCount(1, $data['nearby_patients']);
        $this->assertEquals($nearbySickPatient->id, $data['nearby_patients'][0]['id']);
    }

    public function test_patient_does_not_see_healthy_patients_as_nearby(): void
    {
        $currentPatient = User::factory()->create([
            'account_type' => 'patient',
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        // Healthy patient nearby (should not be shown)
        User::factory()->create([
            'account_type' => 'patient',
            'latitude' => 33.51400,
            'longitude' => 36.27660,
            'health_status' => 'healthy',
        ]);

        $response = $this->actingAs($currentPatient)->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertJson(['status' => 'success']);
        $data = $response->json();
        $this->assertCount(0, $data['nearby_patients']);
    }

    public function test_patient_does_not_see_themselves_as_nearby(): void
    {
        $patient = User::factory()->create([
            'account_type' => 'patient',
            'health_status' => 'patient',
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response = $this->actingAs($patient)->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertJson(['status' => 'success']);
        $data = $response->json();
        $this->assertCount(0, $data['nearby_patients']);
    }

    public function test_medical_staff_cannot_access_nearby_endpoint(): void
    {
        $staff = User::factory()->create(['account_type' => 'medical_staff']);

        $response = $this->actingAs($staff)->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_nearby_endpoint(): void
    {
        $response = $this->postJson('/nearby-patients', [
            'latitude' => 33.51380,
            'longitude' => 36.27650,
        ]);

        $response->assertStatus(401);
    }

    public function test_location_requires_valid_coordinates(): void
    {
        $patient = User::factory()->create(['account_type' => 'patient']);

        $response = $this->actingAs($patient)->postJson('/nearby-patients', [
            'latitude' => 'invalid',
            'longitude' => 36.27650,
        ]);

        $response->assertStatus(422);
    }
}
