<?php

namespace App\Http\Controllers\Ray_employee;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\InvoiceEmpolyeeRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $Invoices;
    public function __construct(InvoiceEmpolyeeRepositoryInterface $Invoices)
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
    public function edit($id)
    {
        return $this->Invoices->edit($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->Invoices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Invoices->destroy($id);
    }
    public function complete()
    {
        return $this->Invoices->complete();
    }
    public function show($id)
    {
        return $this->Invoices->show($id);
    }

}
