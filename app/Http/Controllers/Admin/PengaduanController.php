<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now(); //Current Date and Time
        $data['awal'] = Carbon::parse($today)->startOfMonth()->toDateString();
        $data['akhir'] = Carbon::parse($today)->endOfMonth()->toDateString();
        $data['status'] = "pending";

        if($request->query('awal'))
        {
            $data['awal'] = $request->query('awal');
        }
        if($request->query('akhir'))
        {
            $data['akhir'] = $request->query('akhir');
        }
        if($request->query('status'))
        {
            $data['status'] = $request->query('status');
        }

        $data['pengaduan'] = Pengaduan::with('user')->whereBetween('created_at', [$data['awal'], $data['akhir']])->where('status', $data['status'])->get();
        return view('admin.pengaduan.index', $data);
    }

    public function show(Request $request, int $id)
    {
        $data['pengaduan'] = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.show', $data);
    }

    public function delete(Request $request, int $id)
    {
        $result = Pengaduan::destroy($id);
        if($result > 0){
            return redirect()->back()->with(AlertFormatter::success("Berhasil menghapus pengaduan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Gagal menghapus pengaduan."));
    }
}
