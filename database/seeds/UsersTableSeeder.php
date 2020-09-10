<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'id' => 1,
                'name' => 'hoge',
                'email' => 'hoge@example.com',
                'password' => Hash::make('hogehoge'),
            ],
            [
                'id' => 2,
                'name' => 'fuga',
                'email' => 'fuga@example.com',
                'password' => Hash::make('fugafuga'),
            ],
            [
                'id' => 3,
                'name' => 'kume',
                'email' => 'kume@example.com',
                'password' => Hash::make('kumekume'),
            ],
        ]);
    }
}
