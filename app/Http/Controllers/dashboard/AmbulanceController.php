<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    protected $Ambulance;
    public function __construct(AmbulanceRepositoryInterface $Ambulance){
        $this->Ambulance=$Ambulance;
    }
    public function index()
    {
        return $this->Ambulance->index();
    }

    public function create()
    {
        return $this->Ambulance->create();
    }


    public function store(Request $request)
    {
        return $this->Ambulance->store( $request);
    }


    public function edit($id)
    {
        return $this->Ambulance->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->Ambulance->update( $request, $id);
    }


    public function destroy(Request $request,$id)
    {
        return $this->Ambulance->destroy($request,$id);
    }
}
