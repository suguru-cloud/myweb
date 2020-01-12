<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //管理者の情報
        \App\User::create([
          'name' => 'youyou',
          'email' => 'admin@example.com',
          'password' => bcrypt('xxxxxxx'),
          'role' => 'admin'
          ]);
    }
}
