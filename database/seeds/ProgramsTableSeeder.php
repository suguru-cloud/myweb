<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ProgramsTableSeeder::class);
            DB::table('programs')->insert([
      'theater_id' => '1',            
      'title' => '1789',
      'story' => '革命',
      'performancedates' => '2019年11月20日～2019年12月20日',
      'releasedate' => '2019年7月1日～2019年7月31日',
      ]);
    }
}
