<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

include_once __DIR__ . '/../faker_data/document_number.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'defaulter' => rand(0, 1),
        ];
    }

    public function individual()
    {
        $cpfs = cpfs();

        return $this->state([
            'date_birth' => $this->faker->date(),
            'document_number' => $cpfs[array_rand($cpfs, 1)],
            'sex' => rand(1, 10) % 2 == 0 ? 'm' : 'f',
            'marital_status' => rand(1, 3),
            'physical_disability' => rand(1, 10) % 2 == 0 ? $this->faker->word() : null,
            'client_type' => Client::TYPE_INDIVIDUAL
        ]);
    }

    public function legal()
    {
        $cnpjs = cnpjs();

        return $this->state([
            'document_number' => $cnpjs[array_rand($cnpjs, 1)],
            'company_name' => $this->faker->company(),
            'client_type' => Client::TYPE_LEGAL
        ]);
    }
}
