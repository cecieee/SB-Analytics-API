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
        DB::table('users')->insert([
            'name' => '[YOUR_NAME]',
            'email' => '[SOME_EMAIL]',
            'password' => Hash::make('[SOME_PASSWORD]')
        ]);
    }
}
