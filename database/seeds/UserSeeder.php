<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'role' => "Admin",
            ],
            [
                'name' => 'Client',
                'email' => 'client@client.com',
                'password' => bcrypt('12345678'),
                'role' => "Citizen",
            ],
        ]);


    }
}
