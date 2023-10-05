<?php

namespace App\Repository\doctor_dashboard;

use App\Models\Invoice;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{

    public function Status($invoice_id, $status_id)
    {
        $invoice_status = Invoice::find($invoice_id);
        $invoice_status->update([
            'invoice_status' => $status_id
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'diagnosis' => ['required'],
            'medicine' => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $this->Status($request->invoice_id, 3);
            $diagnostic = Diagnosis::create([
                'date' => now(),
                'diagnosis' => $request->diagnosis,
                'medicine' => $request->medicine,
                'invoice_id' => $request->invoice_id,
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
            ]);
            DB::commit();

            if ($diagnostic) {
                session()->flash('success', __('doctor/invoices.Diagnostic Add Successfully'));
                return redirect()->route('complete_invoices');
            }
            return redirect()->route('doctor_invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $patient_records = Diagnosis::where('patient_id', $id)->get();
        return view('Dashboard.Doctor.invoices.patient_record', compact('patient_records'));
    }

    public function addReview(Request $request)
    {

        try {
            $request->validate([
                'diagnosis' => ['required'],
                'medicine' => ['required'],
                'review_date' => ['required'],
            ]);
            $this->Status($request->invoice_id, 2);
            $diagnostic = Diagnosis::create([
                'date' => now(),
                'review_date' => $request->review_date,
                'diagnosis' => $request->diagnosis,
                'medicine' => $request->medicine,
                'invoice_id' => $request->invoice_id,
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
            ]);
            if ($diagnostic) {
                session()->flash('success', __('doctor/invoices.Diagnostic Add Successfully'));
                return redirect()->route('review_invoices');
            }
            return redirect()->route('doctor_invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // public function destroy($id)
    // {
    //     Diagnosis::find($id)->delete();
    //     session()->flash('delete');
    //     return redirect()->back();
    // }
}
