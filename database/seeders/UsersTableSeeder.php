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
                'name' => 'Kis Cica',
                'email' => 'kiscica@gmail.com',
                'password' => Hash::make('password'),
                'profile_image_url' => 'https://cdn.pixabay.com/photo/2020/06/02/06/17/kitten-5249584_960_720.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        User::factory()->count(10)->create();
    }
}
