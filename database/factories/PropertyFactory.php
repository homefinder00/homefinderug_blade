<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = [
            'Kampala Central', 'Nakawa', 'Banda', 'Bugolobi', 'Ntinda', 'Kololo',
            'Makindye', 'Muyenga', 'Ggaba', 'Kansanga', 'Kabalagala', 'Rubaga',
            'Nansana', 'Kira', 'Mukono', 'Entebbe', 'Wakiso', 'Mpigi',
            'Kawempe', 'Kasubi', 'Makerere', 'Wandegeya', 'Kisenyi', 'Katwe'
        ];

        $propertyTypes = [
            'Modern apartment', 'Cozy house', 'Studio apartment', 'Family home',
            'Townhouse', 'Duplex', 'Single room', 'Double room', 'Self-contained',
            'Boys quarters', 'Guest house', 'Mansion'
        ];

        return [
            'user_id' => User::factory()->landlord(),
            'title' => fake()->randomElement($propertyTypes) . ' in ' . fake()->randomElement($locations),
            'description' => fake()->realText(300),
            'price' => fake()->numberBetween(200000, 2000000), // UGX 200K to 2M
            'location' => fake()->randomElement($locations),
            'rooms' => fake()->numberBetween(1, 8),
            'image_path' => 'properties/' . fake()->randomElement([
                'jd1bhcV3LByAs7o3sjRNRJgR21mxO1wQz6xhF85g.png',
                'WwUl62Ht9aaKr0u1krwHxZ5jqn3lUzAbKram6QzT.jpg'
            ]),
            'status' => fake()->randomElement(['pending', 'approved', 'approved', 'approved']), // More approved
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }

    /**
     * Create an approved property.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    /**
     * Create a pending property.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Create a rejected property.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }
}
