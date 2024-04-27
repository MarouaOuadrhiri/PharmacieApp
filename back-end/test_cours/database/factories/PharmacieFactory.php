<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacie>
 */
class PharmacieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Inbe' => strtoupper($this->faker->bothify('??##??##')),
            'NomPhar' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'VillePh' => $this->faker->city(),
            'Adresse' => $this->faker->streetAddress(),
            'confirmer'=>$this->faker->boolean(),
            'NumTele' => (string) $this->faker->unique()->numerify('0##########'),
            'NumFx' => (string) $this->faker->unique()->numerify('0##########'),
            'password' => Hash::make('password'),
        ];
    }
}
