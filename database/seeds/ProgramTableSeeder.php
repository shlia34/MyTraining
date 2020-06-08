<?php

use Illuminate\Database\Seeder;
use App\Defs\DefSeeder;
use App\Defs\DefMuscle;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            [
                'id' => DefSeeder::PRODUCT_IDS[0],
                'user_id' => DefSeeder::USER_IDS[0],
                'muscle_code' => DefMuscle::MUNE_MUSCLE_CODE,
                'date' => '2020-06-03',
                'memo' => null,
            ],[
                'id' =>DefSeeder::PRODUCT_IDS[1],
                'user_id' => DefSeeder::USER_IDS[0],
                'muscle_code' => DefMuscle::SANTOU_MUSCLE_CODE,
                'date' => '2020-06-03',
                'memo' => 'これはメモです',
            ],
            [
                'id' =>DefSeeder::PRODUCT_IDS[2],
                'user_id' => DefSeeder::USER_IDS[0],
                'muscle_code' => DefMuscle::MUNE_MUSCLE_CODE,
                'date' => '2020-06-07',
                'memo' => null,
            ],
            [
                'id' =>DefSeeder::PRODUCT_IDS[3],
                'user_id' => DefSeeder::USER_IDS[0],
                'muscle_code' => DefMuscle::SENAKA_MUSCLE_CODE,
                'date' => '2020-06-04',
                'memo' => null,
            ]
        ]);
    }
}
