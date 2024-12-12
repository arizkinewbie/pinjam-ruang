<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $room_types = array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Lab',
                'is_active' => 1,
                'created_at' => '2024-12-10 22:52:24',
                'updated_at' => '2024-12-10 22:52:24',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Rapat',
                'is_active' => 1,
                'created_at' => '2024-12-10 22:52:24',
                'updated_at' => '2024-12-10 22:52:24',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('room_types')->first()))
            \DB::table('room_types')->insert($room_types);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
