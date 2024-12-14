<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Admin\Controllers\API\V1\AdministratorApiController;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::with('room_type')->get();
        $data['prodi'] = (new AdministratorApiController())->getAllProdi();
        return view('index', compact('data'));
    }

    public function rooms()
    {
        $data['rooms'] = Room::with('room_type')->get();
        $data['prodi'] = (new AdministratorApiController())->getAllProdi();
        return view('pages.rooms', compact('data'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
