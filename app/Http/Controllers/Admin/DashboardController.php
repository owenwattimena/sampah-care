<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

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
