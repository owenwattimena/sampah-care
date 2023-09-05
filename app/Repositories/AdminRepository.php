<?php
namespace App\Repositories;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

interface AdminRepository{
    public function getAll(?array $except = null) : Collection | null;
    public function get(int $id) : Admin | null;

    public function save(array $data, ?int $id = null) : Admin | null;

    public function delete(int|array $ids) : bool;
}
