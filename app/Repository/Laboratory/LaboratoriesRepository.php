<?php

namespace App\Repository\Laboratory;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Service;
use App\Models\Laboratory;
use App\Models\FundAccount;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\LaboratoryEmployee;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use App\Interfaces\Laboratory\LaboratoriesRepositoryInterface;

class LaboratoriesRepository implements LaboratoriesRepositoryInterface
{
    public function index()
    {
        $laboratories = LaboratoryEmployee::all();
        return view('Dashboard.Laboratory.index',compact('laboratories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Laboratory.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required',],
            'email'=>['required','unique:laboratory_employees,email'],
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]+$/',
        ]);
        $laboratory=LaboratoryEmployee::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if ($laboratory) {
            session()->flash('add');
            return redirect()->route('Laboratorys.index');

        }else{
            return redirect()->route('Laboratorys.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $laboratory=LaboratoryEmployee::find($id);
        $data = $request->except('_token');
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }
        $request->validate([
            'name'=>['required',],
            'email'=>['required','unique:laboratory_employees,email,'.$laboratory->id],
            'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]+$/',
        ]);
        $laboratory->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        if ($laboratory) {
            session()->flash('edit');
            return redirect()->route('Laboratorys.index');
        }else{
            return redirect()->route('Laboratorys.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
    {
        $laboratory=laboratoryEmployee::find($id)->delete();
        if ($laboratory) {
            session()->flash('delete');
            return redirect()->route('Laboratorys.index');
        }else{
            return redirect()->route('Laboratorys.index');
        }
    }
}
