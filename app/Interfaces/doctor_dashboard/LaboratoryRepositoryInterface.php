<?php

namespace  App\Interfaces\doctor_dashboard;

use Illuminate\Http\Request;

interface LaboratoryRepositoryInterface{
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy($id);

}
