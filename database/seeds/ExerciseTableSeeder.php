<?php

use App\Defs\DefMuscle;
use App\Defs\DefSeeder;
use Illuminate\Database\Seeder;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            [
                'id' => DefSeeder::EXERCIZE_IDS[DefSeeder::BENCH_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::BENCH_CODE],
                'muscle_code' => DefMuscle::MUNE_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::INCLINE_BENCH_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::INCLINE_BENCH_CODE],
                'muscle_code' => DefMuscle::MUNE_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::DUMBBELL_FLY_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::DUMBBELL_FLY_CODE],
                'muscle_code' => DefMuscle::MUNE_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::DEAD_LIFT_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::DEAD_LIFT_CODE],
                'muscle_code' => DefMuscle::SENAKA_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::CHINNING_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::CHINNING_CODE],
                'muscle_code' => DefMuscle::SENAKA_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::SEATED_ROW_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::SEATED_ROW_CODE],
                'muscle_code' => DefMuscle::SENAKA_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::PULL_DOWN_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::PULL_DOWN_CODE],
                'muscle_code' => DefMuscle::SANTOU_MUSCLE_CODE,
            ],
            [
                'id' =>DefSeeder::EXERCIZE_IDS[DefSeeder::TRICEPS_EXTENSION_CODE],
                'name' => DefSeeder::EXERCIZE_NAMES[DefSeeder::TRICEPS_EXTENSION_CODE],
                'muscle_code' => DefMuscle::SANTOU_MUSCLE_CODE,
            ],
        ]);
    }
}
