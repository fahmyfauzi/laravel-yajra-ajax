<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'jk' => 'perempuan',
            // 'jk' => 'Laki-laki',
            'email' => fake()->unique()->safeEmail(),
            'alamat' => fake()->address()
        ];
    }
}
