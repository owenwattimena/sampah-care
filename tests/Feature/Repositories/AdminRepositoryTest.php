<?php

namespace Tests\Feature\Repositories;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use App\Repositories\Implement\AdminRepositoryImplement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRepositoryTest extends TestCase
{
    private AdminRepository $adminRepo;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRepo = \App::make(AdminRepositoryImplement::class);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAll()
    {
        $this->assertEmpty($this->adminRepo->getAll());
    }

    public function test_get()
    {
        $admin = $this->adminRepo->get(1);
        $this->assertNotEmpty($admin);
        $this->assertInstanceOf(Admin::class, $admin);
    }

    public function test_save()
    {
        $data = [
            'nama' => 'Owen Wattimena',
            'username' => 'wattimena',
            'password' => '123456',
            'level' => 'admin',
        ];
        $admin = $this->adminRepo->save($data);
        $this->assertInstanceOf(Admin::class, $admin);
        $this->assertEquals('Owen Wattimena', $admin->nama);
        $this->assertEquals('admin', $admin->level);
    }

    public function test_delete()
    {
        $this->assertTrue($this->adminRepo->delete(1));
    }
}
