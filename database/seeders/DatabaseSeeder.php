<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(FisioterapisSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(VideoSeeder::class);
        // $this->call(TokenSeeder::class);
    }
}
