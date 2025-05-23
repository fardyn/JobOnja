<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'salary' => $this->faker->numberBetween(40000, 1200000),
            'description' => $this->faker->paragraph(2, true),
            'tags' => $this->faker->word() . ', ' . $this->faker->word() . ', ' . $this->faker->word(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'temporary', 'intern', 'on-call', 'volunteer']),
            'remote' => $this->faker->boolean(),
            'requirement' => $this->faker->sentence(3, true),
            'benefits' => $this->faker->sentence(2, true),
            'city' => $this->faker->city(),
            'state' => $this->faker->randomElement([
                'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
                'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho',
                'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
                'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
                'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada',
                'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
                'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon',
                'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota',
                'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington',
                'West Virginia', 'Wisconsin', 'Wyoming'
            ]),
            'address' => $this->faker->streetAddress(),
            'zipcode' => $this->faker->postcode(),
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->streetAddress(),
            'company_description' => $this->faker->paragraph(2, true),
            'company_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website' => $this->faker->url(),
        ];
    }
}
