<?php

namespace App\Repository\Ambulance;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Models\Ambulance;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances=Ambulance::all();
        return view('Dashboard.Ambulance.index',compact('ambulances'));
    }
    public function create()
    {
        return view('Dashboard.Ambulance.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'car_number'=>['required','numeric'],
            'car_model'=>['required'],
            'car_year_made'=>['required'],
            'car_type'=>['required'],
            'driver_name'=>['required'],
            'driver_license_number'=>['required'],
            'driver_phone'=>['required','numeric'],
            'notes'=>['required','max:500'],
        ]);

        $data=$request->except('_token');
        Ambulance::create($data);
        return redirect()->route('Ambulances.index')->with('msg',__('Ambulance.Ambulance Add Successfully'))->with('good',__('section_t.Good Job!'));
    }
    public function edit($id)
    {
        $ambulance=Ambulance::find($id);
        return view('Dashboard.Ambulance.edit',compact('ambulance'));
    }
    public function update(Request $request, $id)
    {
        $ambulance=Ambulance::find($id);
        $request->validate([
            'car_number'=>['required','numeric'],
            'car_model'=>['required'],
            'car_year_made'=>['required'],
            'car_type'=>['required'],
            'driver_name'=>['required'],
            'driver_license_number'=>['required'],
            'driver_phone'=>['required','numeric'],
            'notes'=>['required','max:500'],
        ]);

        $data=$request->except('_token');
        $ambulance->update($data);
        return redirect()->route('Ambulances.index')->with('msg',__('Ambulance.Ambulance Updated Successfully'))->with('good',__('section_t.Good Job!'));
    }

    public function destroy(Request $request, $id)
    {
        $ambulances=Ambulance::find($id)->delete();
        return redirect()->route('Ambulances.index')->with('msg',__('Ambulance.Ambulance Deleted Successfully'))->with('good',__('section_t.Good Job!'));
    }
}
