<?php

namespace App\Repository\patient_dashboard;

use App\Models\Ray;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Laboratory;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\patient_dashboard\PatientDashboardRepositoryInterface;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;

class PatientDashboardRepository implements PatientDashboardRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $invoices = Invoice::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.Patients.dashboard.index', compact('invoices'));
    }
    public function laboratory()
    {
        $laboratories = Laboratory::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.Patients.dashboard.laboratory', compact('laboratories'));
    }
    public function ray(){
        $rays = Ray::where('patient_id',auth()->user()->id)->get();
        return view('Dashboard.Patients.dashboard.ray', compact('rays'));
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
        $Patient=Patient::find($id);
        $invoices=Invoice::where('patient_id',$id)->get();
        $receipt_accounts=ReceiptAccount::where('patient_id',$id)->get();
        $Patient_accounts=PatientAccount::where('patient_id',$id)->get();
        return view('Dashboard.Patients.show',compact('Patient','invoices','receipt_accounts','Patient_accounts'));
    }
    public function destroy($id)
    {
        $laboratory=Laboratory::find($id)->delete();
        return view('Dashboard.Laboratory.dashboard');
    }
    public function show_ray($id){
        $ray=Ray::find($id);
        return view('Dashboard.Patients.dashboard.view_rays',compact('ray'));
    }
    public function show_test($id){
        $laboratory=Laboratory::find($id);
        return view('Dashboard.Patients.dashboard.view_test',compact('laboratory'));

    }

}
