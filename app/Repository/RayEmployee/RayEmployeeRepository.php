<?php

namespace App\Repository\RayEmployee;


use App\Models\Ray;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.RayEmployee.index', compact('ray_employees'));
    }
    public function create()
    {
        return view('Dashboard.RayEmployee.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]+$/',
        ]);
        DB::beginTransaction();
        try {
            $ray_employee = RayEmployee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            if ($ray_employee) {
                session()->flash('add');
                return redirect()->route('RayEmployee.index');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $ray_employee = RayEmployee::find($id);
        $data = $request->except('_token');
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:doctors,email,' . $ray_employee->id,
            'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]+$/',
        ]);
        DB::beginTransaction();
        try {

            $ray_employee->update($data);
            DB::commit();
            if ($ray_employee) {
                session()->flash('edit');
                return redirect()->route('RayEmployee.index');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        RayEmployee::find($id)->delete();
        session()->flash('delete');
        return redirect()->route('RayEmployee.index');
    }
}
