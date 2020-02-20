<?php

use Illuminate\Database\Seeder;

class BasicUnit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('basic_units')->insert([
            [
                'name' => 'Residential',
                'unit' => 10,
            ],
            [
                'name' => 'Commercial',
                'unit' => 20,
            ],
        ]);
    }
}
