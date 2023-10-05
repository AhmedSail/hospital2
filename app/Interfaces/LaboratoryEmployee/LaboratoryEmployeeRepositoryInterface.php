<?php

namespace App\Interfaces\LaboratoryEmployee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface LaboratoryEmployeeRepositoryInterface{

    public function index();
    public function complete();
    public function edit($id);
    public function show($id);
    public function update(Request $request,$id);
    public function destroy($id);
}


