<?php

namespace App\Repositories\Implement;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;


class AdminRepositoryImplement implements AdminRepository
{

    public Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getAll(?array $except = null): Collection|null
    {
        $query = $this->admin->query();
        $query = $query->get();
        if ($except)
            $query = $query->except($except);
        return $query;
    }
    public function get(int $id): Admin|null
    {
        $query = $this->admin->query();
        return $query->where('id', $id)->get()->first();
    }

    public function save(array $data, ?int $id = null): Admin|null
    {
        $admin = $this->admin;
        if ($id)
            $admin = $this->admin->findOrFail($id);

        $admin->nama = $data['nama'];
        $admin->no_telp = $data['no_telp'];
        $admin->alamat = $data['alamat'];
        $admin->username = $data['username'];
        if(isset($data['password']))
            $admin->password = Hash::make($data['password']);
        $admin->level = $data['level'];
        $admin->email = $data['email'];
        if($admin->save()) return $admin;
            return null;

    }

    public function delete(int|array $ids): bool
    {
        return ($this->admin->destroy($ids) > 0);
    }
}
