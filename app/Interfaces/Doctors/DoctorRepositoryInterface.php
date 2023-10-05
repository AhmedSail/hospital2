<?php

namespace App\Interfaces\Doctors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface DoctorRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request,$id);
    public function destroy(Request $request,$id);
    public function update_password(Request $request,$id);
    public function update_status(Request $request,$id);

}
