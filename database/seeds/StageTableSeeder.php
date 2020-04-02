<?php

use Illuminate\Database\Seeder;

class StageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert([
            [
                'stage_id' =>'ST10000000000000000000000000000000',
                'name' => 'ベンチプレス',
                'part_code' => '01',
                'pof_code' => '01',
                'memo' => null
            ],
            [
                'stage_id' =>'ST22000000000000000000000000000000',
                'name' => 'インクラインベンチプレス',
                'part_code' => '01',
                'pof_code' => '01',
                'memo' => null
            ],
            [
                'stage_id' =>'ST33300000000000000000000000000000',
                'name' => 'ダンベルフライ',
                'part_code' => '01',
                'pof_code' => '02',
                'memo' => null
            ],
            [
                'stage_id' =>'ST44440000000000000000000000000000',
                'name' => 'デッドリフト',
                'part_code' => '02',
                'pof_code' => '01',
                'memo' => null
            ],
            [
                'stage_id' =>'ST55555000000000000000000000000000',
                'name' => '懸垂',
                'part_code' => '02',
                'pof_code' => '01',
                'memo' => null
            ],
            [
                'stage_id' =>'ST66666600000000000000000000000000',
                'name' => 'シーテッドロー',
                'part_code' => '02',
                'pof_code' => '03',
                'memo' => null
            ],
            [
                'stage_id' =>'ST77777770000000000000000000000000',
                'name' => 'プルダウン',
                'part_code' => '06',
                'pof_code' => '01',
                'memo' => null
            ],
            [
                'stage_id' =>'ST88888888000000000000000000000000',
                'name' => 'トライセプスエクステンション',
                'part_code' => '06',
                'pof_code' => '01',
                'memo' => null
            ],
        ]);
    }
}
