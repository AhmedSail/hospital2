<?php
namespace App\Interfaces\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface GroupRepositoryInterface
{
    public function index();
    public function create();
    public function edit($id);
    public function store(Request $request);
    public function update(Request $request,$id);
    public function destroy(Request $request,$id);
}
