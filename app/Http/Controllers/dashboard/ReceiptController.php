<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $Receipt;
    public function __construct(ReceiptRepositoryInterface $Receipt)
    {
        $this->Receipt=$Receipt;
    }
    public function index()
    {
        return $this->Receipt->index();
    }


    public function create()
    {
        return $this->Receipt->create();
    }


    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }


    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }
    public function show($id)
    {
        return $this->Receipt->show($id);
    }


    public function update(Request $request,$id)
    {
        return $this->Receipt->update($request,$id);
    }


    public function destroy(Request $request,$id)
    {
        return $this->Receipt->destroy($request,$id);
    }
}
