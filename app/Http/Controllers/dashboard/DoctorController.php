<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;


class DoctorController extends Controller
{
    protected $Doctors;

    public function __construct(DoctorRepositoryInterface $Doctors)
    {
        $this->Doctors= $Doctors;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Doctors->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Doctors->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Doctors->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Doctors->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        return $this->Doctors->destroy($request,$id);
    }
    public function update_password(Request $request,$id){
        return $this->Doctors->update_password($request, $id);
    }

    public function update_status(Request $request,$id){
        return $this->Doctors->update_status($request,$id);

    }
}
