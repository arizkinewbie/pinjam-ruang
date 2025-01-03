<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_roles = array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2024-12-10 22:19:17',
                'updated_at' => '2024-12-10 22:19:17',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Staff Perpustakaan',
                'slug' => 'staff',
                'created_at' => '2024-12-10 22:39:30',
                'updated_at' => '2024-12-10 22:39:30',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Mahasiswa',
                'slug' => 'mahasiswa',
                'created_at' => '2024-12-10 22:42:04',
                'updated_at' => '2024-12-10 22:42:04',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_roles')->first()))
            \DB::table('admin_roles')->insert($admin_roles);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
