<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'email' => 'admin@disnaker.com',
        //     'password' => Hash::make('password'),
        //     'isAdmin' => true
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'leader',
        //     'email' => 'leader@disnaker.com',
        //     'password' => Hash::make('password'),
        //     'isAdmin' => false
        // ]);
        SuratMasuk::factory(15)->create();
        SuratKeluar::factory(20)->create();
    }
}