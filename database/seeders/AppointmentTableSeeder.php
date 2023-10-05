<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->delete();
        $Appointments = [
            ['name'=>'السبت'],
            ['name'=>'الأحد'],
            ['name'=>'الاثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الأربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
        ];
        foreach($Appointments as $Appointment){
            Appointment::create($Appointment);
        }


    }
}
