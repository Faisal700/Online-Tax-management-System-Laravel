<?php

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            [
                'user_id' => 2,
                'property_area_id' => 2,
                'type' => 'rent',
                'marla' => '10 to 20',
                'house_no' => 'J1234',
                'address' => 'Johor Town',
            ],
            [
                'user_id' => 2,
                'property_area_id' => 1,
                'type' => 'self',
                'marla' => '10 to 20',
                'house_no' => 'y934',
                'address' => 'Model Town',
            ],
            [
                'user_id' => 2,
                'property_area_id' => 1,
                'type' => 'rent',
                'marla' => 'greater than 20',
                'house_no' => 'Z564',
                'address' => 'Liberty',
            ],
        ]);
    }
}
