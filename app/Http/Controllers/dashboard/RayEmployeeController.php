<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    protected $RayEmployee;
    public function __construct(RayEmployeeRepositoryInterface $RayEmployee)
    {
        $this->RayEmployee=$RayEmployee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->RayEmployee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->RayEmployee->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->RayEmployee->store($request);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->RayEmployee->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->RayEmployee->destroy($id);
    }
}
