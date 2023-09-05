<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index()
    {
        $data['admin'] = $this->adminService->getAll(except:[\Auth::guard('admin')->user()->id]);
        return view('admin.index', $data);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'level' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'username' => 'required|unique:admin,username',
            'password' => 'required',
        ]);
        try {
            if($this->adminService->save($data))
            {
                return redirect()->back()->with(AlertFormatter::success("Berhasil menambahkan data."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Gagal menambahkan data."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Gagal menambahkan data. " . $e->getMessage()));
        }
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
            'level' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
        ]);
        try {
            if($this->adminService->save($data, $id))
            {
                return redirect()->back()->with(AlertFormatter::success("Berhasil mengubah data."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Gagal mengubah data."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Gagal mengubah data. " . $e->getMessage()));
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            if($this->adminService->delete($id))
            {
                return redirect()->back()->with(AlertFormatter::success("Berhasil menghapus data."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Gagal menghapus data."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Gagal menghapus data. " . $e->getMessage()));
        }
    }
}
