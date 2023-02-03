<?php

namespace Database\Seeders;

use App\Models\TokenAgora;
use Illuminate\Database\Seeder;
use App\Models\Video;
class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'name' => 'Lorem Ipsum',
            'token' => 'lorem ipsum dolor sit amet',
        ]);
    }
}
