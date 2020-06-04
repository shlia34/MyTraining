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
        //todo めっちゃ変えなきゃ
        $this->call(UserTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(StageTableSeeder::class);
        $this->call(TrainingTableSeeder::class);
    }
}
