<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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

        $conversation_id = range(1, 10);
        $conversation_id = array_combine($conversation_id, array_fill(0, count($conversation_id), null));
        return [
            'body' => $this->faker->word(),
            'read' => $this->faker->boolean(),
            'sender_id' => $this->faker->randomElement(array_keys($utilisateurIds)),
            'conversation_id'=>$this->faker->randomElement(array_keys($conversation_id)),
        ];
    }
}
