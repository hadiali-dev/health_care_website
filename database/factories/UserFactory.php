<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'account_type' => 'patient',
            'health_status' => 'healthy',
            'remember_token' => Str::random(10),
        ];
    }

    public function medicalStaff(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'medical_staff',
        ]);
    }

    public function sick(): static
    {
        return $this->state(fn (array $attributes) => [
            'health_status' => 'patient',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
