<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'          => 'Mohamed Ghareeb',
            'email'         => 'm@ghareeb.com',
            'profile_image' => 'uploads/admins_images/default.png',
            'password'      => bcrypt('123123'),
        ]);
        Admin::create([
            'name'          => 'Mohamed Alaa',
            'email'         => 'm@alaa.com',
            'profile_image' => 'uploads/admins_images/alaa.jpg',
            'password'      => bcrypt('123123'),
        ]);
    }
}
