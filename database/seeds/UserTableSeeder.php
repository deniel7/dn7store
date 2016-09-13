<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'full_name' => 'Deniel',
            'username' => 'deniel',
            'email' => 'admin@demo.com',
            'role_id' => 1,
            'password' => bcrypt('Nerrazurri7'),
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Date('Y-m-d H:i:s'),
            'updated_at' => Date('Y-m-d H:i:s'),
        ]);
    }
}
