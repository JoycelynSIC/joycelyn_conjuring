<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $faker = \Faker\Factory::create('id_ID');

        // Pastikan admin tidak double
        if (!User::where('email', 'joycelyn@pcr.ac.id')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'joycelyn@pcr.ac.id',
                'password' => Hash::make('123456'),
                'role' => 'super admin', 
                'profile_picture' => null,
            ]);
        }

        // Generate 15 user dummy Indonesia
        for ($i = 0; $i < 15; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('123456'),
                'role' => $faker->randomElement(['pelanggan', 'mitra']), 
                'profile_picture' => null,
            ]);
        }
    }
}
