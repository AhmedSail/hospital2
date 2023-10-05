<?php

namespace App\Repository\RayEmployee;


use App\Models\Ray;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\RayEmployee\InvoiceEmpolyeeRepositoryInterface;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;

class InvoiceEmpolyeeRepository implements InvoiceEmpolyeeRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $rays=Ray::where('case',0)->get();
        return view('Dashboard.RayEmployee.Invoice.index',compact('rays'));
    }
    public function complete()
    {
        $rays=Ray::where('case',1)->get();
        return view('Dashboard.RayEmployee.Invoice.index_completed',compact('rays'));
    }
    public function edit($id)
    {
        $ray=Ray::find($id);
        return view('Dashboard.RayEmployee.Invoice.add',compact('ray'));
    }
    public function update(Request $request, $id)
    {
        $ray=Ray::find($id);
        $request->validate([
            'diagnostic'=>['required'],
            // 'photos' => ['required', 'file'],
        ]);

        DB::beginTransaction();
        try{
            $ray->update([
                'employee_id'=>Auth::user()->id,
                'description_employee'=>$request->diagnostic,
                'case'=>1,
            ]);
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $subfolder = $ray->Patient->name; // احصل على اسم المريض
                    $this->verifyAndStoreImageForeach($photo, 'Rays', $subfolder, 'upload_image', $ray->id, 'App\Models\Ray');
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('complete_invoice_ray');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    public function destroy($id)
    {
    }
    public function show($id){
        $rays=Ray::find($id);
        return view('Dashboard.RayEmployee.Invoice.view_rays',compact('rays'));
    }
}
