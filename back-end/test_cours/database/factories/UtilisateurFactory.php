<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Utilisateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'ville' => $this->faker->city(),
            'numtel' => (string) $this->faker->unique()->numerify('0##########'),
            'confirmer'=>$this->faker->boolean(),
            'password' => Hash::make('password'),
        ];
    }
}
