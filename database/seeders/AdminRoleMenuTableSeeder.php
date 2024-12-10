<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_role_menu = array(
            0 =>
            array(
                'role_id' => 1,
                'menu_id' => 2,
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            1 =>
            array(
                'role_id' => 1,
                'menu_id' => 8,
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_role_menu')->first()))
            \DB::table('admin_role_menu')->insert($admin_role_menu);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
