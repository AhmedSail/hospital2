<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Models\ٍService;
use App\Models\Models\ٍServiceTransaltion;


class SingleServiceController extends Controller
{
    protected $Services;

    /**
     * Display a listing of the resource.
     */
    public function __construct(SingleServiceRepositoryInterface $Services) {
        $this->Services=$Services;
    }
    public function index()
    {
       return $this->Services->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Services->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Services->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Services->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        return $this->Services->destroy($request,$id);
    }
    public function update_status(Request $request,string $id)  {
        return $this->Services->update_status($request,$id);
    }
}
