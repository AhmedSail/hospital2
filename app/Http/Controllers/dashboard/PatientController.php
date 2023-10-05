<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Patients\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $Patient;
    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient=$Patient;
    }
    public function index()
    {
        return $this->Patient->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Patient->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Patient->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Patient->edit($id);
    }
    public function show($id)
    {
        return $this->Patient->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->Patient->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        return $this->Patient->destroy($request,$id);
    }
}
