<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_as_patient(): void
    {
        $response = $this->post('/register', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'male',
            'account_type' => 'patient',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $this->assertDatabaseHas('users', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'account_type' => 'patient',
        ]);
    }

    public function test_new_users_can_register_as_medical_staff(): void
    {
        $response = $this->post('/register', [
            'full_name' => 'Dr. Smith',
            'email' => 'doctor@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'male',
            'account_type' => 'medical_staff',
        ]);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'full_name' => 'Dr. Smith',
            'email' => 'doctor@example.com',
            'account_type' => 'medical_staff',
        ]);
    }

    public function test_registration_requires_valid_data(): void
    {
        $response = $this->post('/register', [
            'full_name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'gender' => 'invalid',
            'account_type' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['full_name', 'email', 'password', 'gender', 'account_type']);
    }
}
