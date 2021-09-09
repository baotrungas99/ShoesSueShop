<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate(); //delete the old seeders

        $adminRoles = Roles::where('name', 'admin')->first();//first()=take(1)->get() lấy đầu tiên và duy nhất
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();
        $viewerRoles = Roles::where('name', 'viewer')->first();

        $admin = Admin::create([
            'admin_name' => 'ChrisAmin',
            'admin_email' => 'admin@gmail.com',
            'admin_phone'=>'0369631514',
            'admin_password'=> md5('123')
        ]);
        $author = Admin::create([
            'admin_name' => 'ChrisAuthor',
            'admin_email' => 'author@gmail.com',
            'admin_phone'=>'0369631514',
            'admin_password'=> md5('123')
        ]);
        $user = Admin::create([
            'admin_name' => 'Chrisuser',
            'admin_email' => 'user@gmail.com',
            'admin_phone'=>'0369631514',
            'admin_password'=> md5('123')
        ]);
        $viewer = Admin::create([
            'admin_name' => 'Chrisviewer',
            'admin_email' => 'viewer@gmail.com',
            'admin_phone'=>'0369631514',
            'admin_password'=> md5('123')
        ]);

        $admin->roles()->attach($adminRoles);
        $user->roles()->attach($userRoles);
        $author->roles()->attach($authorRoles);
        $viewer->roles()->attach($viewerRoles);
    }
}
