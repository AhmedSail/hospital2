<?php

namespace App\Http\Controllers\Laboratory_employee;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{
    protected $Employee;
    public function __construct(LaboratoryEmployeeRepositoryInterface $Employee)
    {
        $this->Employee=$Employee;
    }
    public function index(){
        return $this->Employee->index();
    }
    public function complete(){
        return $this->Employee->complete();
    }
    public function edit($id){
        return $this->Employee->edit($id);
    }
    public function update(Request $request,$id){
        return $this->Employee->update($request,$id);
    }
    public function destroy($id){
        return $this->Employee->destroy($id);
    }
    public function show($id){
        return $this->Employee->show($id);
    }
}
