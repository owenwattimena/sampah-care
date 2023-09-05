<?php
namespace App\Services\Implement;
use App\Models\Admin;
use App\Repositories\AdminRepository;
use App\Services\AdminService;
use Illuminate\Database\Eloquent\Collection;


class AdminServiceImplement implements AdminService
{
    private AdminRepository $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }
    public function getAll(?array $except = null) : Collection | null
    {
        return $this->adminRepo->getAll(except: $except);
    }
    public function get(int $id) : Admin | null
    {
        return $this->adminRepo->get($id);
    }
    public function save(array $data, ?int $id = null) : bool
    {
        if($this->adminRepo->save($data, id: $id)) return true;
            return false;
    }
    public function delete(int|array $ids) : bool
    {
        return $this->adminRepo->delete($ids);
    }
}
