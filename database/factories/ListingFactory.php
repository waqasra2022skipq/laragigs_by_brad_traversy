<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence(),
            'company'=> $this->faker->company(),
            'email'=> $this->faker->companyEmail(),
            'content'=> $this->faker->paragraph(3),
            'website'=> $this->faker->url(),
            'location'=> $this->faker->city(),
            'logo'=>'',
            'expires'=> $this->faker->dateTimeBetween('now', '+1 month')
        ];
    }
}
