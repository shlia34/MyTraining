<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProgramTableSeeder::class);
        $this->call(ExerciseTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(WorkoutTableSeeder::class);
//        $this->call(RoutineTableSeeder::class);
        //routineはめんどくさかったw
    }
}
