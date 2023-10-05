<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetailController extends Controller
{
    function index($id){
        $patient=Patient::find($id);
        $patient_records=Diagnosis::where('patient_id',$id)->get();
        $patient_rays=Ray::where('patient_id',$id)->get();
        $patient_laboratorys=Laboratory::where('patient_id',$id)->get();
        return view('Dashboard.Doctor.invoices.patient_detail',compact('patient_records','patient_rays','patient','patient_laboratorys'));
    }
}
