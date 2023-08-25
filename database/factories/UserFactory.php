<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GrupaZaNastavu;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $grupaIds = GrupaZaNastavu::pluck('id')->toArray();

        return [
            'ime' => $this->faker->firstName(),
            'prezime' => $this->faker->lastName(),
            'broj_indeksa' => $this->faker->numberBetween(2000, 2023) . '/' . str_pad($this->faker->numberBetween(1, 6000), 4, '0', STR_PAD_LEFT),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'administrator' => false,
            'remember_token' => Str::random(10),
            'grupa_za_nastavu_id' => $this->faker->randomElement($grupaIds),
        ];
    }
    
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
