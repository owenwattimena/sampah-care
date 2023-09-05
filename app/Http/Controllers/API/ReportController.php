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
        if($status)
        {
            $query = $query->where('status', $status);
            $query = $query->where('id_user', $user->id);
        }
        return JsonFormatter::success($query->get(), message: "Data pengaduan");
    }
}
