<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Defesa>
 */
class DefesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banca'=> fake()->word(),
            'atas_url'=> fake()->unique()->filePath(),
            'fichas_avaliacao'=> fake()->unique()->filePath()
            
        ];
    }
}
