<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participants')->insert([
            [
                'event_id' => 2,
                'user_id' => 1,
                'status' => 'interested',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 3,
                'user_id' => 1,
                'status' => 'going',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 4,
                'user_id' => 1,
                'status' => 'not_going',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'user_id' => 2,
                'status' => 'going',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 2,
                'user_id' => 2,
                'status' => 'interested',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 3,
                'user_id' => 2,
                'status' => 'going',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 4,
                'user_id' => 2,
                'status' => 'not_going',
                'invited_by_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 8,
                'user_id' => 1,
                'invited_by_user_id' => 2,
                'status' => 'invited',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 7,
                'user_id' => 1,
                'invited_by_user_id' => 3,
                'status' => 'invited',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
