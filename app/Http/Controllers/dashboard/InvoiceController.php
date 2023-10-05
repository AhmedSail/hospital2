<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Invoices\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $Invoices;
    public function __construct(InvoiceRepositoryInterface $Invoices)
    {
        $this->Invoices=$Invoices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Invoices->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Invoices->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Invoices->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Invoices->edit( $id);
    }
    public function show($id)
    {
        return $this->Invoices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        return $this->Invoices->update($request,  $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        return $this->Invoices->destroy($request, $id);
    }
}
