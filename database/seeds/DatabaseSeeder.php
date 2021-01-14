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
        // $this->call(UserSeeder::class);
        DB::table('user_type')->insert([
            'type' => 'Super Admin'
        ]);
        DB::table('user_type')->insert([
            'type' => 'Editor'
        ]);
        DB::table('user_type')->insert([
            'type' => 'Reader'
        ]);
        DB::table('users')->insert([
            'user_type' => 1,
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'user_type' => 2,
            'name' => 'David',
            'email' => 'david@gmail.com',
            'password' => Hash::make('secret'),
        ]);
        DB::table('users')->insert([
            'user_type' => 3,
            'name' => 'Jack',
            'email' => 'jack@gmail.com',
            'password' => Hash::make('protected'),
        ]);
    }
}
