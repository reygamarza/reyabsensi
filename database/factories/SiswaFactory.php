<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Siswa::class;

    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('006#######'),
            'jenis_kelamin' => $this->faker->randomElement(['laki laki', 'perempuan']),
            'nisn' => $this->faker->unique()->numerify('22065#####'),
            'id_kelas' => null, // Nanti diisi dalam seeder
            'id_user' => null,  // Nanti diisi dalam seeder
        ];
    }
}
