<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('locations')->insert([
            [
		'name' =>'Arizona',
                'city' => 'Arizona',
                'state' => 'Arizona',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
               'name' =>'Oklahoma',
                'city' => 'Oklahoma',
                'state' => 'Oklahoma',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            
        ]);
    }
}
