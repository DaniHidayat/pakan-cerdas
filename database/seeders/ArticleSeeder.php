<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'title' => 'Lorem Ipsum',
            'slug' => Str::slug('Lorem Ipsum'),
            'image' => 'sample.jpg',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi doloribus dolores eveniet velit consectetur dolorum praesentium eaque consequatur cum assumenda repudiandae et, incidunt explicabo enim aliquam quod nesciunt non autem!'
        ]);

        Article::create([
            'title' => 'Lorem Ipsum 2',
            'slug' => Str::slug('Lorem Ipsum 2'),
            'image' => 'sample2.jpg',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi doloribus dolores eveniet velit consectetur dolorum praesentium eaque consequatur cum assumenda repudiandae et, incidunt explicabo enim aliquam quod nesciunt non autem!'
        ]);
    }
}
