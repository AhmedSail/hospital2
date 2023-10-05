<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\GroupRepositoryInterface;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $Groups;

    public function __construct(GroupRepositoryInterface $Groups)
    {
        $this->Groups= $Groups;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Groups->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Groups->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Groups->store($request);
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
        return $this->Groups->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Groups->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        return $this->Groups->destroy($request,$id);
    }
}
