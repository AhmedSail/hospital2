<?php

namespace App\Interfaces\Ambulance;

use Illuminate\Http\Request;

interface AmbulanceRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request,$id);
    public function destroy(Request $request,$id);

}
