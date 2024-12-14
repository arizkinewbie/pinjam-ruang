<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_role_users = array(
            0 =>
            array(
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            1 =>
            array(
                'role_id' => 2,
                'user_id' => 2,
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            2 =>
            array(
                'role_id' => 3,
                'user_id' => 3,
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_role_users')->first()))
            \DB::table('admin_role_users')->insert($admin_role_users);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
