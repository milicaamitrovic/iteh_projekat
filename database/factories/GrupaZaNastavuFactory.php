<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GrupaZaNastavu;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GrupaZaNastavu>
 */
class GrupaZaNastavuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grupe=['C1','C2','C3','C4'];
        return [
            'naziv_grupe' => $this->faker->randomElement($grupe)
            
        ];
    }
}
