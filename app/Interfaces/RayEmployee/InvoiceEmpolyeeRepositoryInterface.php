<?php

namespace  App\Interfaces\RayEmployee;

use Illuminate\Http\Request;

interface InvoiceEmpolyeeRepositoryInterface{

    public function index();
    public function complete();
    public function edit($id);
    public function show($id);
    public function update(Request $request,$id);
    public function destroy($id);

}


