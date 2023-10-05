<?php

namespace App\Http\Controllers\patient_dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\patient_dashboard\PatientDashboardRepositoryInterface;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    protected $patients;
    public function __construct(PatientDashboardRepositoryInterface $patients)
    {
        $this->patients=$patients;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->patients->index();
    }


    /**
     * Display the specified resource.
     */
    public function show_ray($id)
    {
        return $this->patients->show_ray($id);
    }
    public function show_test($id)
    {
        return $this->patients->show_test($id);
    }
    public function show($id)
    {
        return $this->patients->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->patients->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->patients->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->patients->destroy($id);
    }
    public function ray(){
        return $this->patients->ray();
    }
    public function laboratory(){
        return $this->patients->laboratory();
    }
}
