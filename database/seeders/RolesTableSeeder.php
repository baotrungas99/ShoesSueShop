<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();//xoá dữ liệu cũ
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'author']);
        Roles::create(['name' => 'user']);
        Roles::create(['name' => 'viewer']);
    }
}
