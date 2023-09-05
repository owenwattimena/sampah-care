<?php

namespace Tests\Feature\Services;

use App\Models\Admin;
use App\Services\AdminService;
use App\Services\Implement\AdminServiceImplement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminServiceTest extends TestCase
{
    private AdminService $adminService;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminService = \App::make(AdminServiceImplement::class);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAll()
    {
        $this->assertNotEmpty($this->adminService->getAll());
    }

    public function test_get()
    {
        $admin = $this->adminService->get(3);
        $this->assertNotEmpty($admin);
        $this->assertInstanceOf(Admin::class, $admin);
    }

    public function test_save()
    {
        $data = [
            'nama' => 'Owen Wattimena',
            'username' => 'wattimena',
            'no_telp' => '085244140715',
            'alamat' => 'Wayame',
            'password' => '123456',
            'level' => 'admin',
        ];
        $this->assertTrue($this->adminService->save($data));
    }

    public function test_delete()
    {
        $this->assertFalse($this->adminService->delete(1));
    }
}
