<?php

namespace  App\Interfaces\doctor_dashboard;

use Illuminate\Http\Request;

interface DiagnosisRepositoryInterface{

    public function store(Request $request);
    public function addReview(Request $request);
    public function show($id);
    // public function destroy($id);

}


