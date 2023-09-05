<?php
namespace App\Services;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

interface AdminService
{
    public function getAll(?array $except = null) : Collection | null;
    public function get(int $id) : Admin | null;
    public function save(array $data, ?int $id = null) : bool;
    public function delete(int|array $ids) : bool;
}
