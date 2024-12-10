<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = array(
            0 =>
            array(
                'id' => 1,
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => '/auth/login
                                /auth/logout',
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => '/auth/roles
                                /auth/permissions
                                /auth/menu
                                /auth/logs',
                'created_at' => '2024-12-10 10:21:03',
                'updated_at' => '2024-12-10 10:21:03',
            ),
            5 =>
            array(
                'id' => 6,
                'name' => 'Admin helpers',
                'slug' => 'ext.helpers',
                'http_method' => '',
                'http_path' => '/helpers/*',
                'created_at' => '2024-12-10 22:20:58',
                'updated_at' => '2024-12-10 22:20:58',
            ),
            6 =>
            array(
                'id' => 7,
                'name' => 'List Room Types',
                'slug' => 'list.room_types',
                'http_method' => 'GET',
                'http_path' => '/room-types*',
                'created_at' => '2024-12-10 01:32:56',
                'updated_at' => '2024-12-10 02:08:23',
            ),
            7 =>
            array(
                'id' => 8,
                'name' => 'Create Room Type',
                'slug' => 'create.room_types',
                'http_method' => 'POST',
                'http_path' => '/room-types*',
                'created_at' => '2024-12-10 01:47:16',
                'updated_at' => '2024-12-10 02:09:02',
            ),
            8 =>
            array(
                'id' => 9,
                'name' => 'Edit Room Type',
                'slug' => 'edit.room_types',
                'http_method' => 'PUT',
                'http_path' => '/room-types/*',
                'created_at' => '2024-12-10 01:54:49',
                'updated_at' => '2024-12-10 02:09:47',
            ),
            9 =>
            array(
                'id' => 11,
                'name' => 'Delete Room Type',
                'slug' => 'delete.room_types',
                'http_method' => 'DELETE',
                'http_path' => '/room-types/*',
                'created_at' => '2024-12-10 02:01:03',
                'updated_at' => '2024-12-10 02:01:03',
            ),
            10 =>
            array(
                'id' => 12,
                'name' => 'List Rooms',
                'slug' => 'list.rooms',
                'http_method' => 'GET',
                'http_path' => '/rooms*',
                'created_at' => '2024-12-10 02:11:31',
                'updated_at' => '2024-12-10 02:11:31',
            ),
            11 =>
            array(
                'id' => 13,
                'name' => 'Create Room',
                'slug' => 'create.rooms',
                'http_method' => 'POST',
                'http_path' => '/rooms*',
                'created_at' => '2024-12-10 02:11:55',
                'updated_at' => '2024-12-10 02:11:55',
            ),
            12 =>
            array(
                'id' => 14,
                'name' => 'Edit Room',
                'slug' => 'edit.rooms',
                'http_method' => 'PUT',
                'http_path' => '/rooms/*',
                'created_at' => '2024-12-10 02:12:23',
                'updated_at' => '2024-12-10 02:12:23',
            ),
            13 =>
            array(
                'id' => 15,
                'name' => 'Delete Room',
                'slug' => 'delete.rooms',
                'http_method' => 'DELETE',
                'http_path' => '/rooms/*',
                'created_at' => '2024-12-10 02:12:40',
                'updated_at' => '2024-12-10 02:12:40',
            ),
            14 =>
            array(
                'id' => 16,
                'name' => 'List Borrow Room',
                'slug' => 'list.borrow_rooms',
                'http_method' => 'GET',
                'http_path' => '/borrow-rooms*',
                'created_at' => '2024-12-10 02:13:24',
                'updated_at' => '2024-12-10 02:13:24',
            ),
            15 =>
            array(
                'id' => 17,
                'name' => 'Create Borrow Room',
                'slug' => 'create.borrow_rooms',
                'http_method' => 'POST',
                'http_path' => '/borrow-rooms*',
                'created_at' => '2024-12-10 02:13:49',
                'updated_at' => '2024-12-10 02:13:49',
            ),
            16 =>
            array(
                'id' => 18,
                'name' => 'Edit Borrow Room',
                'slug' => 'edit.borrow_rooms',
                'http_method' => 'PUT',
                'http_path' => '/borrow-rooms/*',
                'created_at' => '2024-12-10 02:14:12',
                'updated_at' => '2024-12-10 02:14:12',
            ),
            17 =>
            array(
                'id' => 19,
                'name' => 'Delete Borrow Room',
                'slug' => 'delete.borrow_rooms',
                'http_method' => 'DELETE',
                'http_path' => '/borrow-rooms/*',
                'created_at' => '2024-12-10 02:14:35',
                'updated_at' => '2024-12-10 02:14:35',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_permissions')->first()))
            \DB::table('admin_permissions')->insert($admin_permissions);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
