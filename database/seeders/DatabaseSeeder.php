<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Admin::create([
            "nama" => "Administrator",
            "username" => "admin",
            "password" => Hash::make("123456"),
            "level" => "admin",
            "no_telp" => "085244140715",
            "alamat" => "Wayame",
        ]);
    }
}
