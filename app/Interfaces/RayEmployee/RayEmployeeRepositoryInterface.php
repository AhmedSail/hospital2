<?php

namespace  App\Interfaces\RayEmployee;

use Illuminate\Http\Request;

interface RayEmployeeRepositoryInterface{

    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy($id);

}


