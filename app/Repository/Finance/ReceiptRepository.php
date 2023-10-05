<?php

namespace App\Repository\Finance;

use App\Models\Patient;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Finance\ReceiptRepositoryInterface;

class ReceiptRepository implements ReceiptRepositoryInterface
{
    public function index()
    {
        $receipts=ReceiptAccount::all();
        return view('Dashboard.Receipt.index',compact('receipts'));
    }


    public function create()
    {
        $patients=Patient::all();
        return view('Dashboard.Receipt.add',compact('patients'));
    }


    public function store(Request $request)
{
    $request->validate([
        'patient_id' => ['required'],
        'Debit' => ['required'],
        'description' => ['required'],
    ]);

    $receipts = ReceiptAccount::create([
        'date' => now(),
        'patient_id' => $request->patient_id,
        'amount' => $request->Debit,
        'description' => $request->description
    ]);

    FundAccount::create([
        'date' => now(),
        'receipt_id' => $receipts->id,
        'debit' => $request->Debit,
        'credit' => 0.00
    ]);

    PatientAccount::create([
        'date' => now(),
        'receipt_id' => $receipts->id,
        'patient_id' => $request->patient_id,
        'debit' => 0.00,
        'credit' => $request->Debit,
    ]);

    if ($receipts) {
        return redirect()->route('Receipts.index')
            ->with('msg', __('Finance.Receipt Add Successfully'))
            ->with('good', __('section_t.Good Job!'));
    } else {
        return redirect()->route('Receipts.index');
    }
}

    public function show($id){
        $receipt=ReceiptAccount::find($id);
        return view('Dashboard.Receipt.print',compact('receipt'));
    }

    public function edit($id)
    {
        $receipt=ReceiptAccount::find($id);
        $Patients=Patient::all();
        return view('Dashboard.Receipt.edit',compact('receipt','Patients'));
    }


    public function update(Request $request,$id)
    {
        $receipt=ReceiptAccount::find($id);
        $fundAccount = FundAccount::where('receipt_id',$receipt->id)->first();
        $patientAccount = PatientAccount::where('receipt_id',$receipt->id)->first();
        $request->validate([
            'patient_id' => ['required'],
            'Debit' => ['required'],
            'description' => ['required'],
        ]);

        $receipt->update([
            'date' => now(),
            'patient_id' => $request->patient_id,
            'amount' => $request->Debit,
            'description' => $request->description
        ]);
        $fundAccount->update([
            'date' => now(),
            'receipt_id' => $receipt->id,
            'debit' => $request->Debit,
            'credit' => 0.00
        ]);

        $patientAccount->update([
            'date' => now(),
            'receipt_id' => $receipt->id,
            'patient_id' => $request->patient_id,
            'debit' => 0.00,
            'credit' => $request->Debit,
        ]);
        if ($receipt) {
            return redirect()->route('Receipts.index')
                ->with('msg', __('Finance.Receipt Updated Successfully'))
                ->with('good', __('section_t.Good Job!'));
        } else {
            return redirect()->route('Receipts.index');
        }
    }


    public function destroy(Request $request,$id)
    {
        $receipts=ReceiptAccount::find($id)->delete();
        return redirect()->route('Receipts.index')
            ->with('msg', __('Finance.Receipt Deleted Successfully'))
            ->with('good', __('section_t.Good Job!'));
    }
}

