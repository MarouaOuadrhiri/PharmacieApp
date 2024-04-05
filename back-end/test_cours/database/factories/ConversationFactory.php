<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    

    public function definition(): array
    {
        $utilisateurIds = range(1, 10);
        $utilisateurIds = array_combine($utilisateurIds, array_fill(0, count($utilisateurIds), null));

        $pharmacieId = range(1, 10);
        $pharmacieId = array_combine($pharmacieId, array_fill(0, count($pharmacieId), null));
        return [
            'utilisateur_id' => $this->faker->randomElement(array_keys($utilisateurIds)),
            'pharmacie_id' => $this->faker->randomElement(array_keys($pharmacieId)),
        ];
    }
}
