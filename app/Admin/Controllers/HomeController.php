<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Pinjam Ruang Diskusi')
            ->row(function (Row $row) {
                // Widget for room types
                $row->column(3, function (Column $column) {
                    $count_room_types = DB::table('room_types')->whereNull('deleted_at')->count();
                    $infoBox = new InfoBox('Tipe Ruangan', 'cubes', 'green', route('panel.room-types.index'), $count_room_types);
                    $column->append($infoBox);
                });

                // Widget for rooms
                $row->column(3, function (Column $column) {
                    $count_rooms = DB::table('rooms')->whereNull('deleted_at')->count();
                    $infoBox = new InfoBox('Ruangan', 'trello', 'yellow', route('panel.rooms.index'), $count_rooms);
                    $column->append($infoBox);
                });

                // Widget for borrow rooms
                $row->column(3, function (Column $column) {
                    //jika user selain admin maka hanya menampilkan peminjaman yang dia buat
                    if (\Admin::user()->isRole('mahasiswa')) {
                        $count_borrow_rooms = DB::table('borrow_rooms')->where('borrower_id', \Admin::user()->id)->whereNull('deleted_at')->count();
                    } else {
                        $count_borrow_rooms = DB::table('borrow_rooms')->whereNull('deleted_at')->count();
                    }
                    $infoBox = new InfoBox('Peminjaman', 'calendar', 'red', route('panel.borrow-rooms.index'), $count_borrow_rooms);
                    $column->append($infoBox);
                });
                // Widget for users
                $row->column(3, function (Column $column) {
                    $count_users = DB::table('admin_users')->whereNull('deleted_at')->count();
                    $infoBox = new InfoBox('Pengguna', 'users', 'aqua', route('admin.auth.users.index'), $count_users);
                    if (!\Admin::user()->isRole('mahasiswa')) {
                        $column->append($infoBox);
                    }
                });
            });
            /*
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append($this->admin_user_info());
                });
            });*/
    }

    public function admin_user_info()
    {
        $admin_user = \Admin::user();
        $data['admin_user_first_name'] = ucfirst(strtolower(explode(' ', $admin_user->name)[0]));
        $data['greetings'] = $this->Greetings(Carbon::now()->format('H'));
        $data['is_new_admin_user'] = false;

        if ( // Check user if same password with username
            Hash::check($admin_user->username, $admin_user->password)
            || $admin_user->created_at == $admin_user->updated_at
        ) {
            $data['is_new_admin_user'] = true;
        }

        return view('dashboard.admin_user_info', compact('data'));
    }

    public function Greetings($hours)
    {
        if ($hours >= 0 && $hours <= 11)
            return "Pagi";
        else if ($hours >= 12 && $hours <= 14)
            return "Siang";
        else if ($hours >= 15 && $hours <= 17)
            return "Sore";
        else if ($hours >= 17 && $hours <= 18)
            return "Petang";
        else if ($hours >= 19 && $hours <= 23)
            return "Malam";
    }
}
