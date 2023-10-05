<?php
namespace App\Interfaces\Sections;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface SectionRepositoryInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
    public function destroy(Request $request);
    public function show($id);
}
