<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'nama' => 'Owen',
            'totalPending' => '0',
            'pengaduan' => []
        ];
        Mail::to('wentoxwtt@gmail.com')->send(new NotificationMail('mail.admin.index', $data));

        $query = Pengaduan::query();
        $query = $query->get();

        $data['statistik']=[
            'pending' => $query->where('status', 'pending')->count(),
            'proses' => $query->where('status', 'proses')->count(),
            'selesai' => $query->where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard.index', $data);
    }
}
