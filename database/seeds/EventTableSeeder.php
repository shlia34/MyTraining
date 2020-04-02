<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'event_id' =>'EV00000000000000000000000000000001',
                'user_id' => 'US00000000000000000000000000000000',
                'part_code' => '01',
                'date' => '2020-04-03',
                'memo' => null,
            ],[
                'event_id' =>'EV00000000000000000000000000000022',
                'user_id' => 'US00000000000000000000000000000000',
                'part_code' => '06',
                'date' => '2020-04-03',
                'memo' => 'これはメモです',
            ],
            [
                'event_id' =>'EV00000000000000000000000000000333',
                'user_id' => 'US00000000000000000000000000000000',
                'part_code' => '01',
                'date' => '2020-04-07',
                'memo' => null,
            ],
            [
                'event_id' =>'EV00000000000000000000000000004444',
                'user_id' => 'US00000000000000000000000000000000',
                'part_code' => '02',
                'date' => '2020-04-04',
                'memo' => null,
            ]
        ]);
    }
}
