<?php
namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Insurance\InsuranceRepositoryInterface;

class InsuranceController extends Controller
{
    protected $Insurance;

    public function __construct(InsuranceRepositoryInterface $Insurance)
    {
        $this->Insurance= $Insurance;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Insurance->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Insurance->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Insurance->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Insurance->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Insurance->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        return $this->Insurance->destroy($request,$id);
    }
}
