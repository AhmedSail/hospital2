<?php

namespace App\Repository\Insurance;

use Illuminate\Http\Request;
use App\Interfaces\Insurance\InsuranceRepositoryInterface;
use App\Models\Insurance;

class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function index()
    {
        $insurances=Insurance::all();
        return view('Dashboard.Insurance.index',compact('insurances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $insurances=Insurance::all();
        return view('Dashboard.Insurance.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'insurance_code'=>['required'],
            'name'=>['required'],
            'discount_percentage'=>['required'],
            'Company_rate'=>['required'],
            'notes'=>['required','max:500'],
        ]);
        $data=$request->except('_token');
        Insurance::create($data);

        return redirect()->route('Insurances.index')->with('msg',__('Insurance.Insurance Add Successfully'))->with('good',__('section_t.Good Job!'));
    }


    public function edit($id)
    {
        $insurance=Insurance::find($id);
        return view('Dashboard.Insurance.edit',compact('insurance'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $insurance=Insurance::find($id);
        $request->validate([
            'insurance_code'=>['required','unique:insurances,insurance_code,'.$insurance->id],
            'name'=>['required','unique:insurance_translations,name,'.$insurance->id],
            'discount_percentage'=>['required'],
            'Company_rate'=>['required'],
            'notes'=>['required','max:500'],
        ]);
        $data=$request->except('_token');
        $insurance->update($data);
        return redirect()->route('Insurances.index')->with('msg',__('Insurance.Insurance Updated Successfully'))->with('good',__('section_t.Good Job!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $insurance=Insurance::find($id)->delete();
        return redirect()->route('Insurances.index')->with('msg',__('Insurance.Insurance Deleted Successfully'))->with('good',__('section_t.Good Job!'));
    }
}
