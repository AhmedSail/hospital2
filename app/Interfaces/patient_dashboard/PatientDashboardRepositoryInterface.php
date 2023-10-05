<?php

namespace App\Interfaces\patient_dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface PatientDashboardRepositoryInterface{

    public function index();
    public function ray();
    public function laboratory();
    public function edit($id);
    public function show($id);
    public function update(Request $request,$id);
    public function destroy($id);
    public function show_ray($id);
    public function show_test($id);
}


