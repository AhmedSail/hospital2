<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Laboratory\LaboratoriesRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    protected $Laboratory;
    public function __construct(LaboratoriesRepositoryInterface $Laboratory)
    {
        $this->Laboratory=$Laboratory;
    }
    public function index()
    {
        return $this->Laboratory->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Laboratory->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Laboratory->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->Laboratory->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Laboratory->destroy($id);
    }
}
