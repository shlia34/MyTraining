<?php

use App\Defs\DefSeeder;
use Illuminate\Database\Seeder;

class WorkoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workouts')->insert([
            [
                'id' =>'WO0000000000000000000000000000000a',
                'menu_id' =>DefSeeder::MENU_IDS[0],
                'weight' => 60,
                'rep' => 10,
                'is_max' => 0,
            ],
            [
                'id' =>'WO0000000000000000000000000000000b',
                'menu_id' =>DefSeeder::MENU_IDS[0],
                'weight' => 80,
                'rep' => 6,
                'is_max' => 1,
            ],
            [
                'id' =>'WO0000000000000000000000000000000c',
                'menu_id' =>DefSeeder::MENU_IDS[0],
                'weight' => 70,
                'rep' => 10,
                'is_max' => 0,
            ],

            [
                'id' =>'WO0000000000000000000000000000000d',
                'menu_id' =>DefSeeder::MENU_IDS[1],
                'weight' => 40,
                'rep' => 10,
                'is_max' => 0,
            ],
            [
                'id' =>'WO0000000000000000000000000000000e',
                'menu_id' =>DefSeeder::MENU_IDS[1],
                'weight' => 35,
                'rep' => 12,
                'is_max' => 0,
            ],

            [
                'id' =>'WO0000000000000000000000000000000f',
                'menu_id' =>DefSeeder::MENU_IDS[2],
                'weight' => 65,
                'rep' => 10,
                'is_max' => 0,
            ],

            [
                'id' =>'WO000000000000000000000000000000ad',
                'menu_id' =>DefSeeder::MENU_IDS[2],
                'weight' => 59,
                'rep' => 6,
                'is_max' => 1,
            ],
            [
                'id' =>'WO000000000000000000000000000000ae',
                'menu_id' =>DefSeeder::MENU_IDS[2],
                'weight' => 50,
                'rep' => 6,
                'is_max' => 0,
            ],

            [
                'id' =>'WO000000000000000000000000000000bc',
                'menu_id' =>DefSeeder::MENU_IDS[3],
                'weight' => 100,
                'rep' => 1,
                'is_max' => 1,
            ],
            [
                'id' =>'WO000000000000000000000000000000bd',
                'menu_id' =>DefSeeder::MENU_IDS[3],
                'weight' => 90,
                'rep' => 2,
                'is_max' => 0,
            ],

            [
                'id' =>'WO000000000000000000000000000000be',
                'menu_id' =>DefSeeder::MENU_IDS[4],
                'weight' => 45,
                'rep' => 10,
                'is_max' => 0,
            ],
            [
                'id' =>'WO000000000000000000000000000000bf',
                'menu_id' =>DefSeeder::MENU_IDS[4],
                'weight' => 40,
                'rep' => 9,
                'is_max' => 0,
            ],
            [
                'id' =>'WO000000000000000000000000000000ca',
                'menu_id' =>DefSeeder::MENU_IDS[5],
                'weight' => 20,
                'rep' => 10,
                'is_max' => 0,
            ],
            [
                'id' =>'WO000000000000000000000000000000cb',
                'menu_id' =>DefSeeder::MENU_IDS[5],
                'weight' => 18,
                'rep' => 12,
                'is_max' => 0,
            ],
            [
                'id' =>'WO000000000000000000000000000000cc',
                'menu_id' =>DefSeeder::MENU_IDS[5],
                'weight' => 18,
                'rep' => 10,
                'is_max' => 0,
            ],
        ]);
    }
}
