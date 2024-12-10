<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_users = array (
            0 =>
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$9Dd3WypDzkEr5QdFR7m4kuKNRJ4CP1OSP7pkU0GbtNTkTSj2Ohiua',
                'name' => 'Admin Pinjam Ruang Diskusi',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-08-11 10:21:03',
                'updated_at' => '2021-08-11 10:21:03',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'username' => 'staff',
                'password' => '$2y$10$9Dd3WypDzkEr5QdFR7m4kuKNRJ4CP1OSP7pkU0GbtNTkTSj2Ohiua',
                'name' => 'Staff Perpustakaan UEU Bekasi',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-08-11 10:21:03',
                'updated_at' => '2021-08-11 10:21:03',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'username' => '20200801373',
                'password' => '$2y$10$9Dd3WypDzkEr5QdFR7m4kuKNRJ4CP1OSP7pkU0GbtNTkTSj2Ohiua',
                'name' => 'Anjang Putra Rahman',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-08-11 10:21:03',
                'updated_at' => '2021-08-11 10:21:03',
                'deleted_at' => NULL,
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_users')->first()))
            \DB::table('admin_users')->insert($admin_users);
        else
            echo "\e[31mTable is not empty, therefore NOT ";

    }
}
