<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices)
    {
        $this->invoices=$invoices;
    }

    public function index()
    {
        return $this->invoices->index();
    }
    public function review_invoices()
    {
        return $this->invoices->review_invoices();
    }
    public function complete_invoices()
    {
        return $this->invoices->complete_invoices();
    }
    public function showLaboratorie($id){
        return $this->invoices->showLaboratorie($id);
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        return $this->invoices->show($id);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
