<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Groups\GroupInvoiceRepositoryInterface;

class GroupInvoicesController extends Controller
{
    protected $Groups;
    public function __construct(GroupInvoiceRepositoryInterface $Groups)
    {
        $this->Groups=$Groups;
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
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Groups->edit( $id);
    }
    public function show($id)
    {
        return $this->Groups->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        return $this->Groups->update($request,  $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        return $this->Groups->destroy($request, $id);
    }
}
