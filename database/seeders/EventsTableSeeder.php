<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'Laravel Conference',
                'date' => '2024-07-20 10:00:00',
                'location' => 'Budapest, Hungary',
                'image_url' => 'https://i.ytimg.com/vi/KBigS5vLwZk/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBbPM_lpFCFp4TTXyOKt_zj3uTSqg',
                'type' => 'conference',
                'visibility' => 'public',
                'description' => 'A conference about Laravel and PHP development. Join us to learn about the latest trends in web development and network with other developers. The conference will cover topics such as Laravel, PHP, and web design.',
                'creator_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Online Coding Bootcamp',
                'date' => '2024-08-15 14:00:00',
                'location' => 'Online',
                'image_url' => 'https://cdn.ostad.app/course/cover/2024-05-08T11-05-49.225Z-Full%20Stack%20Web%20Development%20with%20PHP,%20Laravel%20&%20Vue%20JS%20(1).jpg',
                'type' => 'bootcamp',
                'visibility' => 'public',
                'description' => 'An online bootcamp to learn web development. Join us to learn about PHP, Laravel, and Vue.js programming. The bootcamp will cover the basics of web development and help you build your first web application.',
                'creator_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laravel Meetup',
                'date' => '2024-09-10 18:00:00',
                'location' => 'Berlin, Germany',
                'image_url' => 'https://meetup.laravel.com/images/social.png',
                'type' => 'meetup',
                'visibility' => 'public',
                'description' => 'A meetup for Laravel developers. Join us to network with other developers, share your projects, and learn about the latest features in Laravel. The meetup will include talks, workshops, and networking opportunities.',
                'creator_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PHP Workshop',
                'date' => '2024-10-05 09:00:00',
                'location' => 'Paris, France',
                'image_url' => 'https://training.shirosoft.com/images/workshop/workshop1.png',
                'type' => 'workshop',
                'visibility' => 'public',
                'description' => 'A workshop to learn PHP programming. Join us to learn the basics of PHP, build your first web application, and get hands-on experience with PHP programming. The workshop is suitable for beginners and intermediate developers.',
                'creator_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JavaScript Conference',
                'date' => '2024-11-20 10:00:00',
                'location' => 'London, UK',
                'image_url' => 'https://i.ytimg.com/vi/1zyUTZDf3vE/maxresdefault.jpg',
                'type' => 'conference',
                'visibility' => 'private',
                'description' => 'A conference about JavaScript programming. Join us to learn about the latest trends in JavaScript development, network with other developers, and share your projects. The conference will cover topics such as React, Angular, and Node.js.',   
                'creator_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
