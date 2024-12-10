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
                'password' => '$2y$10$k2jNYZ66DQeRnDVVei4kOeceRvvvU70bJkZo4fHhTDFYivPCeLW52',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'bwMPZyAVO3dD4ttpf6NH6RtpZvt14qgokxHx1QaLVzsgShaiYxNmv4WTZmwt',
                'created_at' => '2021-08-11 10:21:03',
                'updated_at' => '2021-08-11 10:21:03',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 3,
                'username' => '100017',
                'password' => '$2y$10$djyNIh8z5goDqbAYnen/C.QWIhT67vMLcCAc.xmdRAOlg4/J7PgDS',
                'name' => 'Metta Santiputri, S.T., M.Sc., Ph.D',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-08-11 10:21:03',
                'updated_at' => '2021-08-11 10:21:03',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 4,
                'username' => '100015',
                'password' => '$2y$10$KH8E/RhSKTYkPyG8A6VMp.cgQJpikcFwN8I75.DiDiOmnev7Z4H2u',
                'name' => 'Uuf Brajawidagda, S.T., M.T., Ph.D',
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
