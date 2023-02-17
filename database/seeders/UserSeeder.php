<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Hannan',
            'last_name' => 'Bhuiyan',
            'username' => 'hannan_001',
            'email' => "hannan@gmail.com",
            'role' => 2,
            'image' => 'backend/assets/uploads/default.png',
            'password' => Hash::make('hannan@gmail.com')
        ]);

        Admin::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
        ]);
        Admin::create([
            'email' => 'muhammadmahbub07@gmail.com',
            'password' => Hash::make('muhammadmahbub07@gmail.com'),
        ]);
    }
}
