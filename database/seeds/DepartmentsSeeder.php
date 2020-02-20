<?php

use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => 'Sui Nathern Gas',
                'tax' => 15,
            ],
            [
                'name' => 'Water',
                'tax' => 20,
            ],
        ]);
    }
}
