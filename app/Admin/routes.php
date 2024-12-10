<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\RoomController;
use App\Admin\Controllers\RoomTypeController;
use App\Admin\Controllers\BorrowRoomController;
use App\Admin\Controllers\API\V1\RoomApiController;
use App\Admin\Controllers\API\V1\AdministratorApiController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('room-types', RoomTypeController::class);
    $router->resource('rooms', RoomController::class);
    $router->resource('borrow-rooms', BorrowRoomController::class);

    $router->group(['prefix' => 'api'], function (Router $router) {
        // AdministratorApiController
        $router->get('college-students', [AdministratorApiController::class, 'getCollegeStudents']);
        $router->get('lecturers', [AdministratorApiController::class, 'getLecturers']);
        $router->get('administrators', [AdministratorApiController::class, 'getAdministrators']);

        // RoomApiController
        $router->get('rooms', [RoomApiController::class, 'getRooms']);
    });
});
