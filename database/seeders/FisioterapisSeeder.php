<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Fisioterapis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FisioterapisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fisioterapis::create([
            'name'              => 'Fisioterapis',
            'email'             => 'fisioterapis@gmail.com',
            'password'          => Hash::make('fisioterapis123'),
            'email_verified_at' => Carbon::now(),
            'address'           => 'Jl. Mawar 1',
            'village'           => 'Cipawitra',
            'district'          => 'Mangkubumi',
            'city'              => 'Tasikmalaya',
            'province'          => 'Jawa Barat',
            'photo'             => 'sample.png',
            'price'             => 500000,
            'about'             => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
            'phone'             => '088123123123'
        ]);

        Fisioterapis::create([
            'name'              => 'Fisioterapis 2',
            'email'             => 'fisioterapis2@gmail.com',
            'password'          => Hash::make('fisioterapis123'),
            'email_verified_at' => Carbon::now(),
            'address'           => 'Jl. Mawar 2',
            'village'           => 'Cipawitra',
            'district'          => 'Mangkubumi',
            'city'              => 'Tasikmalaya',
            'province'          => 'Jawa Barat',
            'price'             => 400000,
            'about'             => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
            'photo'             => 'sample2.png',
            'phone'             => '088123123123'
        ]);
    }
}
