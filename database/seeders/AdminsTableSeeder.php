<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin_name',
            'password' => Hash::make('admin_password'),
        ]);
        $this->call(AdminsTableSeeder::class);
    }

}
