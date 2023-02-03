<?php

namespace Database\Seeders;

use App\Models\Fisioterapis;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fisioterapis = Fisioterapis::whereName('Fisioterapis')->first();
        $fisioterapis2 = Fisioterapis::whereName('Fisioterapis 2')->first();

        Image::create([
            'fisioterapis_id' => $fisioterapis->fisioterapis_id,
            'image'           => 'sample.png'
        ]);

        Image::create([
            'fisioterapis_id' => $fisioterapis->fisioterapis_id,
            'image'           => 'sample2.png'
        ]);

        Image::create([
            'fisioterapis_id' => $fisioterapis2->fisioterapis_id,
            'image'           => 'sample.png'
        ]);

        Image::create([
            'fisioterapis_id' => $fisioterapis2->fisioterapis_id,
            'image'           => 'sample2.png'
        ]);
    }
}
