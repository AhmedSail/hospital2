<?php

namespace App\Repository\doctor_dashboard;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\doctor_dashboard\LaboratoryRepositoryInterface;
use App\Models\Laboratory;

class LaboratoryRepository implements LaboratoryRepositoryInterface
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $laboratory = Laboratory::create([
                'description' => $request->description,
                'invoice_id' => $request->invoice_id,
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
            ]);
            DB::commit();
            if ($laboratory) {
                session()->flash('add');
                return redirect()->back();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $laboratory = Laboratory::findOrFail($id);
            $laboratory->update([
                'description' => $request->description,
            ]);
            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        Laboratory::find($id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
