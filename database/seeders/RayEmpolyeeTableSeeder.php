<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RayEmpolyeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RayEmployee::create([
            'name'=>'ahmed',
            'email'=>'ahmedEmployee@gmail.com',
            'password'=>123456,

        ]);
    }
}
