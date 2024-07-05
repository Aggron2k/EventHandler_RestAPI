<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Horváth Krisztián',
                'email' => 'kriszcso4@gmail.com',
                'password' => Hash::make('password'),
                'profile_image_url' => 'https://avatars.githubusercontent.com/u/40773753?v=4&size=64',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        User::factory()->count(10)->create();
    }
}
