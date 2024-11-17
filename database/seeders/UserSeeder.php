<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "NIPP"=> "223307066",
            "name"=> "admin",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("12345678"),
            "role"=> "admin",
        ]);
        $admin->assignRole("admin");

        $staff = User::create([
            "NIPP"=> "223307055",
            "name"=> "staff",
            "email"=> "staff@gmail.com",
            "password"=> bcrypt("12345678"),
            "role"=> "staff",
        ]);
        $staff->assignRole("staff");
    }
}
