<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'              => 'bronze',
            'price'             => '0',
            'features'          => 'This Plan Is Free But You Not Receive The Notifications In The Site And In Your E-Mail',
            'image'             =>  'uploads/defaults_icon/bronze.jpg',
            'notification_type' => 'no notification',
        ]);
        Plan::create([
            'name'              => 'silver',
            'price'             => '50',
            'features'          => 'This Plan Is For 50$ But You Receive The Notifications In The Site',
            'image'             => 'uploads/defaults_icon/silver.jpg',
            'notification_type' => 'in-site',
        ]);
        Plan::create([
            'name'              => 'gold',
            'price'             => '100',
            'features'          => 'This Plan Is For 100$ But You Receive The Notifications In The Site And In Your E-Mail',
            'image'             => 'uploads/defaults_icon/gold.png',
            'notification_type' => 'in-site & e-mail',
        ]);
    }
}
