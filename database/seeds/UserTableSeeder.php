<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'user_id' => 'US00000000000000000000000000000000',
                'name' => "初期ユーザー",
                'weight' =>  null,
                'email' => "sample@sample",
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
            ]
        ]);
    }
}
