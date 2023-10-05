<?php

namespace App\Repository\LaboratoryEmployee;

use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Traits\UploadTrait;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $laboratory = Laboratory::where('case', 0)->get();
        return view('Dashboard.Laboratory.Invoice.index', compact('laboratory'));
    }
    public function complete()
    {
        $laboratorys = Laboratory::where('case', 1)->get();
        return view('Dashboard.Laboratory.Invoice.index_completed', compact('laboratorys'));
    }
    public function edit($id)
    {
        $laboratory = Laboratory::find($id);
        return view('Dashboard.Laboratory.Invoice.add', compact('laboratory'));
    }
    public function update(Request $request, $id)
    {

        $laboratory = Laboratory::find($id);
        $request->validate([
            'diagnostic' => ['required'],
            // 'photos' => ['required', 'file'],
        ]);

        DB::beginTransaction();
        try {
            $laboratory->update([
                'employee_id' => Auth::user()->id,
                'description_employee' => $request->diagnostic,
                'case' => 1,
            ]);
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $subfolder = $laboratory->Patient->name; // احصل على اسم المريض
                    $this->verifyAndStoreImageForeach($photo, 'Laboratories', $subfolder, 'upload_image', $laboratory->id, 'App\Models\Laboratory');
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('complete_invoice');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $laboratory=Laboratory::find($id);
        return view('Dashboard.Laboratory.Invoice.view_rays',compact('laboratory'));
    }
    public function destroy($id)
    {
        $laboratory=Laboratory::find($id)->delete();
        return view('Dashboard.Laboratory.dashboard');
    }
}
