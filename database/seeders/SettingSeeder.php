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
    }
}
