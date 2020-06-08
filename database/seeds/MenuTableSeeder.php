<?php

use App\Defs\DefSeeder;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *PRreturn void
     */

    public function run()
    {
        DB::table('menus')->insert([
            [
                'id' => DefSeeder::MENU_IDS[0],
                'program_id' =>DefSeeder::PRODUCT_IDS[0],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::BENCH_CODE],
            ],
            [
                'id' =>DefSeeder::MENU_IDS[1],
                'program_id' =>DefSeeder::PRODUCT_IDS[0],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::INCLINE_BENCH_CODE],
            ],
            //胸
            [
                'id' =>DefSeeder::MENU_IDS[2],
                'program_id' =>DefSeeder::PRODUCT_IDS[1],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::PULL_DOWN_CODE],
            ],
            //三頭
            [
                'id' =>DefSeeder::MENU_IDS[3],
                'program_id' =>DefSeeder::PRODUCT_IDS[2],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::BENCH_CODE],
            ],
            [
                'id' =>DefSeeder::MENU_IDS[4],
                'program_id' =>DefSeeder::PRODUCT_IDS[2],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::INCLINE_BENCH_CODE],
            ],
            [
                'id' =>DefSeeder::MENU_IDS[5],
                'program_id' =>DefSeeder::PRODUCT_IDS[2],
                'exercise_id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::DUMBBELL_FLY_CODE],
            ],
            //胸
        ]);
    }
}
