<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'title' => 'Lorem Ipsum',
            'description' => 'lorem ipsum dolor sit amet',
            'video' => 'sample.mp4'
        ]);

        Video::create([
            'title' => 'Lorem Ipsum 2',
            'description' => 'lorem ipsum dolor sit amet 2',
            'video' => 'sample2.mp4'
        ]);
    }
}
