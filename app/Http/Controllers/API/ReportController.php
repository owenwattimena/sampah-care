<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function show(Request $request, int $id)
    {
        $report = Pengaduan::findOrFail($id);
        return JsonFormatter::success($report, message: "Detail pengaduan");
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
        $validator = Validator::make($request->all(), [
            'isi' => 'required',
            'foto' => 'required|file',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        // return JsonFormatter::error("Pengaduan gagal. ", data: $request->all());
        if ($validator->fails()) {
            return JsonFormatter::error($validator->errors()->first(), data: $validator->errors()->all(), code: 422);
        }

        $data = $validator->getData();
        $data['id_user'] = $user->id;
        $data['status'] = 'pending';

        try {
            $foto = $request->file('foto');
            $fileName = round(microtime(true) * 1000) . '.' . $foto->extension();
            $foto->move("public/report", $fileName);
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

// https://coderadvise.com/upload-file-or-image-on-laravel-through-rest-api/
