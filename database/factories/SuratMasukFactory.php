<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'nosurat' => $faker->numerify('No-####'), // Nomor surat unik
            'subjek' => $faker->sentence,
            'pengirim' => $faker->company, // Nama perusahaan atau instansi sebagai pengirim
            'file' => $faker->mimeType(), // Nama file atau path file (asumsi menggunakan file generator dari Faker)
            'status' => $faker->randomElement(['Diproses', 'Ditindaklanjutin', 'Ditolak', 'Disesuaikan']),
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'), // Tanggal dibuat acak antara 1 tahun yang lalu hingga sekarang
            'updated_at' => $faker->dateTimeBetween('-1 year', 'now'), // Tanggal diupdate acak antara 1 tahun yang lalu hingga sekarang
        ];
    }
}