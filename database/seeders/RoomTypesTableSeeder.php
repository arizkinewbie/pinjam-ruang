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
                'created_at' => '2021-08-04 22:52:24',
                'updated_at' => '2021-08-04 22:52:24',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Kelas',
                'is_active' => 1,
                'created_at' => '2021-08-04 22:52:24',
                'updated_at' => '2021-08-04 22:52:24',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Workspace Multimedia',
                'is_active' => 1,
                'created_at' => '2021-08-05 19:09:56',
                'updated_at' => '2021-08-05 19:09:56',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Workspace Rendering',
                'is_active' => 1,
                'created_at' => '2021-08-05 19:20:58',
                'updated_at' => '2021-08-05 19:20:58',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Workspace Software Development',
                'is_active' => 1,
                'created_at' => '2021-08-05 19:21:08',
                'updated_at' => '2021-08-05 19:21:08',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('room_types')->first()))
            \DB::table('room_types')->insert($room_types);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
