<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $Payment;
    public function __construct(PaymentRepositoryInterface $Payment)
    {
        $this->Payment=$Payment;
    }
    public function index()
    {
        return $this->Payment->index();
    }


    public function create()
    {
        return $this->Payment->create();
    }


    public function store(Request $request)
    {
        return $this->Payment->store($request);
    }




    public function edit($id)
    {
        return $this->Payment->edit($id);
    }
    public function show($id)
    {
        return $this->Payment->show($id);
    }


    public function update(Request $request,$id)
    {
        return $this->Payment->update($request,$id);
    }


    public function destroy(Request $request,$id)
    {
        return $this->Payment->destroy($request,$id);
    }
}
