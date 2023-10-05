<?php

namespace App\Interfaces\Laboratory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface LaboratoriesRepositoryInterface{

    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy($id);
}


