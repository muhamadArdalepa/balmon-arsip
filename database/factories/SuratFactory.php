<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surat>
 */
class SuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor' => fake()->unique()->randomNumber(4) . '/' . strtoupper(fake()->lexify()) . '/.' . fake()->randomNumber(5, false) . '/' . strtoupper(fake()->lexify()),
            'jenis' => fake()->randomElement([1, 2]),
            'from_or_to' => fake()->company(),
            'perihal' => fake()->sentence(),
            'tanggal' => fake()->date(),
            'file' => 'storage/surat/file.pdf',
            'status' => fake()->randomElement(['Menunggu tindakan', 'Sudah didisposisikan', 'Sudah diterima oleh Kasubag']),
            'kasubag_id' => fake()->randomElement([1, 5]),
        ];
    }
}
