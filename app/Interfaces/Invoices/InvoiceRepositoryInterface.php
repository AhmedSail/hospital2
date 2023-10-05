<?php

namespace App\Interfaces\Invoices;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface InvoiceRepositoryInterface{

    public function index();
    public function create();
    public function edit($id);
    public function show($id);
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy(Request $request,$id);
}


