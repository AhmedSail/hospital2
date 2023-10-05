<?php

namespace App\Repository\Finance;

use App\Models\Patient;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\PaymentAccount;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payments = PaymentAccount::all();
        return view('Dashboard.Payment.index', compact('payments'));
    }


    public function create()
    {
        $patients = Patient::all();
        return view('Dashboard.Payment.add', compact('patients'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => ['required'],
            'Debit' => ['required'],
            'description' => ['required'],
        ]);

        $payments = PaymentAccount::create([
            'date' => now(),
            'patient_id' => $request->patient_id,
            'amount' => $request->Debit,
            'description' => $request->description
        ]);

        FundAccount::create([
            'date' => now(),
            'payment_id' => $payments->id,
            'debit' => 00.0,
            'credit' => $request->Debit
        ]);

        PatientAccount::create([
            'date' => now(),
            'payment_id' => $payments->id,
            'patient_id' => $request->patient_id,
            'debit' => $request->Debit,
            'credit' =>  0.00,
        ]);

        if ($payments) {
            return redirect()->route('Payment.index')
                ->with('msg', __('Payment.Payment Add Successfully'))
                ->with('good', __('section_t.Good Job!'));
        } else {
            return redirect()->route('Payment.index');
        }
    }




    public function edit($id)
    {
        $payments=PaymentAccount::find($id);
        $Patients=Patient::all();
        return view('Dashboard.Payment.edit',compact('payments','Patients'));
    }
    public function show($id){
        $payments=PaymentAccount::find($id);
        return view('Dashboard..Payment.print',compact('payments'));
    }

    public function update(Request $request,$id)
    {
        $payments=PaymentAccount::find($id);
        $fundAccount = FundAccount::where('payment_id',$payments->id)->first();
        $patientAccount = PatientAccount::where('payment_id',$payments->id)->first();
        $request->validate([
            'patient_id' => ['required'],
            'Debit' => ['required'],
            'description' => ['required'],
        ]);

        $payments->update([
            'date' => now(),
            'patient_id' => $request->patient_id,
            'amount' => $request->Debit,
            'description' => $request->description
        ]);
        $fundAccount->update([
            'date' => now(),
            'payment_id' => $payments->id,
            'debit' => 0.00,
            'credit' =>$request->Debit
        ]);

        $patientAccount->update([
            'date' => now(),
            'payment_id' => $payments->id,
            'patient_id' => $request->patient_id,
            'debit' => $request->Debit,
            'credit' => 0.00,
        ]);
        if ($payments) {
            return redirect()->route('Payment.index')
                ->with('msg', __('Payment.Payment Updated Successfully'))
                ->with('good', __('section_t.Good Job!'));
        } else {
            return redirect()->route('Payment.index');
        }
    }


    public function destroy(Request $request,$id)
    {
        $payments=PaymentAccount::find($id)->delete();
        return redirect()->route('Payment.index')
            ->with('msg', __('Payment.Payment Deleted Successfully'))
            ->with('good', __('section_t.Good Job!'));
    }
}
