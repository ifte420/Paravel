<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone_number',
            'setting_value' => '12345456485',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email_address',
            'setting_value' => '430@gmail.com',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'address',
            'setting_value' => '52 Web Bangale , Adress line2 , ip:3105',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'footer_short_description',
            'setting_value' => 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'facebook_link',
            'setting_value' => 'https://facebook.com ',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'twitter_link',
            'setting_value' => 'ddsfsdfsdfdsf',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'linkedin_link',
            'setting_value' => 'ddsfsdfsdfdsf',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'offer_date',
            'setting_value' => '2031/12/25',
        ]);
    }
}
