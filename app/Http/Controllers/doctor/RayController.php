<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\RayRepositoryInterface;
use Illuminate\Http\Request;

class RayController extends Controller
{
    protected $Ray;
    public function __construct(RayRepositoryInterface $Ray)
    {
        $this->Ray=$Ray;
    }


    public function store(Request $request)
    {
        return $this->Ray->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return $this->Ray->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Ray->destroy($id);
    }
}
