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
        DB::table('users')->insert([
            'name' => 'Roula ALRohban',
            'email' => 'roula.rohban@gmail.com',
            'password' => Hash::make('123456789'),
            'type' => 'super_admin',
        ]);

    }
}
