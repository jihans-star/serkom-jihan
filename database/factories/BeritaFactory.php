<?php

namespace Database\Factories;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(3),
            'isi' => fake()->paragraph(),
            'tanggal' => fake()->date(),
            'gambar' => 'default.jpg',
            'id_user' => User::factory(),
        ];
    }
}
