<?php

namespace App\Interfaces\Finance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function show($id);
    public function update(Request $request,$id);
    public function destroy(Request $request,$id);

}


