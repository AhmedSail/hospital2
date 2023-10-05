<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\LaboratoryRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    protected $Laboratory;
    public function __construct(LaboratoryRepositoryInterface $Laboratory)
    {
        $this->Laboratory=$Laboratory;
    }

    public function store(Request $request)
    {
        return $this->Laboratory->store($request);
    }


    public function update(Request $request,$id)
    {
        return $this->Laboratory->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->Laboratory->destroy($id);
    }
}
