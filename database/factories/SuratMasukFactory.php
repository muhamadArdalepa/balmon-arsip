<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomor' => fake()->unique()->randomNumber(4) . '/' . strtoupper(fake()->lexify()) . '/.' . fake()->randomNumber(5, false) . '/' . strtoupper(fake()->lexify()),
            'pengirim' => fake()->company(),
            'perihal' => fake()->sentence(),
            'tanggal' => fake()->date(),
            'file' => 'file.pdf'
        ];
    }
}
