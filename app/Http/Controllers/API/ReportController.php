<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Pengaduan::query();
        $status = $request->query('status');
        if ($status) {
            $query = $query->where('status', $status);
            $query = $query->where('id_user', $user->id);
        }
        return JsonFormatter::success($query->get(), message: "Data pengaduan");
    }

    public function getTotalReport(Request $request)
    {
        $user = $request->user();
        $query = Pengaduan::query();
        $query = $query->where('id_user', $user->id);
        $query = $query->get();

        return JsonFormatter::success([
            'pending' => $query->where('status', 'pending')->count(),
            'proses' => $query->where('status', 'proses')->count(),
            'selesai' => $query->where('status', 'selesai')->count(),
        ], message: "Data pengaduan");

    }

    public function save(Request $request)
    {
        $user = $request->user();
        $validator = \Validator::make($request->all(), [
            'isi' => 'required',
            'foto' => 'required|file',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error($validator->errors()->first(), data: $validator->errors()->all(), code: 422);
        }

        $data = $validator->getData();
        $data['id_user'] = $user->id;
        $data['status'] = 'pending';

        try {
            $fileName = round(microtime(true) * 1000) . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->storageAs("public/report", $fileName);
            $filePath = 'public/report/' . $fileName;
            $data['foto'] = $filePath;
            $result = Pengaduan::create($data);
            if ($result) {
                return JsonFormatter::success(null, message: "Pengaduan berhasil.");
            }
            return JsonFormatter::error("Pengaduan gagal.");

        } catch (\Exception $e) {
            return JsonFormatter::error("Pengaduan gagal. " . $e->getMessage());
        }
    }
}
