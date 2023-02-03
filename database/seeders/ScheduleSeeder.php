<?php

namespace Database\Seeders;

use App\Models\Fisioterapis;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
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

        $fisioterapis->schedules()->create([
            'day'  => 'Senin',
            'type' => 'Offline',
            'from' => '08:00',
            'to'   => '17:00'
        ]);

        $fisioterapis->schedules()->create([
            'day'  => 'Senin',
            'type' => 'Online',
            'from' => '17:00',
            'to'   => '22:00'
        ]);

        $fisioterapis2->schedules()->create([
            'day'  => 'Senin',
            'type' => 'Offline',
            'from' => '08:00',
            'to'   => '17:00'
        ]);

        $fisioterapis2->schedules()->create([
            'day'  => 'Senin',
            'type' => 'Online',
            'from' => '17:00',
            'to'   => '22:00'
        ]);
    }
}
