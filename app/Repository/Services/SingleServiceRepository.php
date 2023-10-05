<?php

namespace App\Repository\Services;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{
    function index()
    {
        $services = Service::all();
        return view('Dashboard.Service.Single Service.index', compact('services'));
    }
    public function create()
    {
        $services = Service::all();
        return view('Dashboard.Service.Single Service.add', compact('services'));
    }
    function store(Request $request)
    {
        $request->validate([
            // 'name' => ['required','unique:service,name,'.$request->id],
            'price' => ['required','numeric'],
            'description' => ['required', 'max:500'],
        ]);

        $data = $request->except('_token');
        Service::create($data);

        return redirect()->route('Service.index')->with('msg', __('service.Service Add Successfully'))->with('good', __('section_t.Good Job!'));
    }

    function update(Request $request, $id)
    {
        $service=Service::find($id);
        $request->validate([
            'name' => ['required','unique:service_translations,name,'.$service->id.',service_id'],
            'price' => ['required'],
            'description' => ['required', 'max:500'],
        ]);
        $data = $request->except('_token');
        $service->update($data);

        return redirect()->route('Service.index')->with('msg', __('service.Service Updated Successfully'))->with('good', __('section_t.Good Job!'));
    }

    function destroy(Request $request, $id)
    {
        $service=Service::find($id)->delete();

        return redirect()->route('Service.index')->with('msg', __('service.Service Deleted Successfully'))->with('good', __('section_t.Good Job!'));
    }
    function update_status(Request $request,$id)
    {
        $service=Service::find($id);
        Validator::make($request->all(),[
            'status'=>['required','in:0,1']
        ]);
        $data=$request->only('status');
         $service->update($data);
         return redirect()->back()->with('msg',__('doctor.Status Updated Successfully'))->with('good',__('section_t.Good Job!'));
    }
}
