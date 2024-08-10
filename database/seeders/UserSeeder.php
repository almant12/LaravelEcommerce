<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'admin',
                'lastname'=>'Adminuser',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'status'=>'inactive',
                'password'=>bcrypt('password')
            ],
            [
                'id'=>3,
                'name'=>'user',
                'lastname'=>'user',
                'email'=>'user@gmail.com',
                'role'=>'user',
                'status'=>'active',
                'password'=>bcrypt('password')
            ],
            [
                'id'=>2,
                'name'=>'vendor',
                'lastname'=>'Vendoruser',
                'email'=>'vendor@gmail.com',
                'role'=>'vendor',
                'status'=>'active',
                'password'=>bcrypt('password')
            ]
        ]);
    }
}
