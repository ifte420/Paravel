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
            'setting_name' => 'website_logo',
            'setting_value' => 'https://i.ibb.co/kBk71Ky/logo.png',
        ]);
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
        DB::table('settings')->insert([
            'setting_name' => 'about_website',
            'setting_value' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt rerum tenetur illum explicabo pariatur beatae minima nam ipsa. Maiores molestiae molestias, nemo odio impedit cumque nobis nesciunt alias in numquam magni eos excepturi libero fuga temporibus fugiat! Quasi, quod sed dolores non dolorem dolor sint similique. Quaerat reiciendis neque aliquam!',
        ]);
    }
}
