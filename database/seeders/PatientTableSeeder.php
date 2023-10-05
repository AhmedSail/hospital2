<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'name'=>'ahmed',
            'Address'=>'سلطة النقد',
            'email'=>'ahmed@gmail.com',
            'password'=>123456,
            'date_birth'=>'2006-07-31',
            'phone'=>'0592855602',
            'gender'=>1,
            'blood_group'=>'A+',

        ]);
    }
}
