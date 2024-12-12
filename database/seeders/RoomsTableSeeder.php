<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rooms = array(
            0 =>
            array(
                'id' => 1,
                'name' => '601',
                'max_people' => 20,
                'status' => 0,
                'notes' => NULL,
                'room_type_id' => 1,
                'created_at' => '2024-12-10 19:08:55',
                'updated_at' => '2024-12-10 19:11:17',
                'deleted_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'name' => '604',
                'max_people' => 20,
                'status' => 0,
                'notes' => NULL,
                'room_type_id' => 2,
                'created_at' => '2024-12-10 19:19:45',
                'updated_at' => '2024-12-10 19:19:45',
                'deleted_at' => NULL,
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('rooms')->first()))
            \DB::table('rooms')->insert($rooms);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
