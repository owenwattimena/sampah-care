<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.pengguna.index', $data);
    }

    public function delete(Request $request, int $id)
    {
        $result = User::destroy($id);
        if($result > 0){
            return redirect()->back()->with(AlertFormatter::success("Berhasil menghapus pengguna."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Gagal menghapus pengguna."));
    }
}
