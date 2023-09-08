<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now(); //Current Date and Time
        $data['awal'] = Carbon::parse($today)->startOfMonth()->toDateString();
        $data['akhir'] = Carbon::parse($today)->endOfMonth()->toDateString();
        $data['status'] = "pending";

        if ($request->query('awal')) {
            $data['awal'] = $request->query('awal');
        }
        if ($request->query('akhir')) {
            $data['akhir'] = $request->query('akhir');
        }
        if ($request->query('status')) {
            $data['status'] = $request->query('status');
        }

        $data['pengaduan'] = Pengaduan::with('user')->whereBetween('created_at', [$data['awal'], $data['akhir']])->where('status', $data['status'])->get();
        return view('admin.pengaduan.index', $data);
    }

    public function show(Request $request, int $id)
    {
        $data['pengaduan'] = Pengaduan::with('tanggapan')->findOrFail($id);
        return view('admin.pengaduan.show', $data);
    }

    public function tanggapi(Request $request, int $id)
    {
        // Validasi data
        $data = $request->validate([
            'status' => 'required',
            'isi'   => 'required'
        ]);
        $data['id_admin'] = Auth::guard('admin')->user()->id; // ambil id admin

        // cek apakah perubahan status yg dikirim adalah pending atau bukan
        if ($request->status == 'pending')
            return redirect()->back()->with(AlertFormatter::danger("Harap pilih status selain 'pending'!."));
        
        // ambil data pengaduan by id
        $pengaduan = Pengaduan::findOrFail($id);
        $data['id_pengaduan'] = $pengaduan->id; // ambil id pegaduan

        // cek apakah status pengaduan terakhir adalah proses atau bukan 
        if($pengaduan->status == 'proses')
        {

            if($request->status == 'proses') return redirect()->back()->with(AlertFormatter::danger("Harap pilih status selain 'proses'!."));
        }
        if($pengaduan->status == 'selesai') return redirect()->back()->with(AlertFormatter::danger("Tidak dapat memberikan tanggapan, Status pengaduan telah selesai."));



        $tanggapan = Tanggapan::where('id_pengaduan', $pengaduan->id)->first();
        // dd($tanggapan != null);
        if($tanggapan) $fototanggapan = $tanggapan->foto; // ambil foto lama
        if($request->file('foto') != null)
        {
            $foto = $request->file('foto');
            $fileName = round(microtime(true) * 1000) . '.' . $foto->extension();
            $foto->move("public/report/tanggapan", $fileName);
            $filePath = 'public/report/tanggapan/' . $fileName;
            $data['foto'] = $filePath;
            if(isset($fototanggapan ))$tanggapan->foto = $filePath;
        }

        if($tanggapan != null)
        {
            $tanggapan->isi = $data['isi']; 
            $tanggapan = $tanggapan->save();
            
            if($fototanggapan != null)
            {
                unlink($fototanggapan);
            }
            
        }else{   
            $tanggapan = Tanggapan::create($data);
        }

        if($tanggapan)
            $pengaduan->status = $request->status;
            $pengaduan->save();
            return redirect()->back()->with(AlertFormatter::success("Berhasil memberikan tanggapan."));
        return redirect()->back()->with(AlertFormatter::danger("Gagal memberikan tanggapan."));
    }

    public function delete(Request $request, int $id)
    {
        $result = Pengaduan::destroy($id);
        if ($result > 0)
            return redirect()->back()->with(AlertFormatter::success("Berhasil menghapus pengaduan."));
        return redirect()->back()->with(AlertFormatter::danger("Gagal menghapus pengaduan."));
    }
}
