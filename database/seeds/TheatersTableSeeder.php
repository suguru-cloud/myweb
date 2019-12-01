<?php

use Illuminate\Database\Seeder;

class TheatersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(TheatersTableSeeder::class);
        DB::table('theaters')->insert([
            'title' => '帝国劇場',
            'address' => '東京都',
            'access' => '日比谷駅から徒歩5分'
            ]);
    }
}
