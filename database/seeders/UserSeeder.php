<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'User',
            'email'             => 'danihidayat015@gmail.com',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'phone'             => '08123123123',
            'birth_date'        => '1997-01-02',
            'address'           => 'Jl. Melati 1',
            'village'           => 'Cipawitra',
            'district'          => 'Mangkubumi',
            'city'              => 'Tasikmalaya',
            'province'          => 'Jawa Barat',
            'gender'            => 'Male',
            'height'            => '170',
            'weight'            => '70'
        ]);
    }
}
