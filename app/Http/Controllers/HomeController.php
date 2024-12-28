<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Admin\Controllers\API\V1\AdministratorApiController;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function storeContactForm(Request $request)
    {
        try {
            $data = $request->all();
            $name = $data['name'];
            $nim = $data['nim'];
            $email = $data['email'];
            $hp = $data['hp'];
            $note = $data['message'];
            
            Mail::send('emails.contact-form', [
                'name' => $name,
                'email' => $email,
                'nim' => $nim,
                'hp' => $hp,
                'note' => $note,
            ], function ($message) use ($data) {
                $message->to(config('app.email'), 'Admin Perpustaakaan')
                    ->subject('Contact Form dari ' . $data['name'] . ' (' . $data['nim'] . ')');
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dikirim. Terima kasih!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal dikirim. Coba lagi!',
                'error' => $e->getMessage()
            ]);
        }
    }
}
