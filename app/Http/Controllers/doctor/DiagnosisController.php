<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    protected $Diagnosis;
    public function __construct(DiagnosisRepositoryInterface $Diagnosis)
    {
        $this->Diagnosis = $Diagnosis;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function addReview(Request $request)
    {
        return $this->Diagnosis->addReview($request);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Diagnosis->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Diagnosis->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // return $this->Diagnosis->destroy($id);
    }
}
