<?php

namespace App\Repository\Patients;

use App\Models\Patient;

use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\single_invoice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\GroupInvoice;
use App\Models\Invoice;

class PatientRepository implements PatientRepositoryInterface
{

    public function index()
    {
        $Patients = Patient::all();
        return view('Dashboard.Patients.index', compact('Patients'));
    }

    public function create()
    {
        return view('Dashboard.Patients.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:patients,email'],
            'Date_Birth' => ['required', 'date'],
            'Phone' => ['required', 'min:10', 'unique:patients,phone'],
            'Gender' => ['required'],
            'Blood_Group' => ['required'],
            'Address' => ['required'],
        ]);
        $patient=Patient::create([
            'email' => $request->email,
            'password' => Hash::make($request->Phone),
            'date_birth' => $request->Date_Birth,
            'phone' => $request->Phone,
            'gender' => $request->Gender,
            'blood_group' => $request->Blood_Group,
            'name' => $request->name,
            'Address' => $request->Address,
        ]);
        if ($patient) {
            return redirect()->route('Patients.index')->with('msg', __('Patient.Patient Add Successfully'))->with('good', __('section_t.Good Job!'));
        }else{
            return redirect()->route('Patients.create');
        }
    }


    public function edit($id)
    {
        $Patient = Patient::find($id);
        return view('Dashboard.Patients.edit', compact('Patient'));
    }
    public function show($id)
    {
        $Patient = Patient::find($id);
        $invoices = Invoice::where('patient_id', $Patient->id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $Patient->id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $Patient->id)->get();
        return view('Dashboard.Patients.show', compact('Patient','invoices', 'receipt_accounts', 'Patient_accounts'));
    }

    public function update(Request $request, $id)
    {
        $Patient = Patient::find($id);
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:patients,email,' . $Patient->id],
            'Date_Birth' => ['required', 'date'],
            'Phone' => ['required', 'min:10', 'unique:patients,phone,' . $Patient->id],
            'Gender' => ['required'],
            'Blood_Group' => ['required'],
            'Address' => ['required'],
        ]);
        $Patient->update([
            'email' => $request->email,
            'password' => Hash::make($request->Phone),
            'date_birth' => $request->Date_Birth,
            'phone' => $request->Phone,
            'gender' => $request->Gender,
            'blood_group' => $request->Blood_Group,
            'name' => $request->name,
            'Address' => $request->Address,
        ]);
        return redirect()->route('Patients.index')->with('msg', __('Patient.Patient Updated Successfully'))->with('good', __('section_t.Good Job!'));
    }


    public function destroy(Request $request, $id)
    {
        $Patient = Patient::find($id)->delete();
        return redirect()->route('Patients.index')->with('msg', __('Patient.Patient Deleted Successfully'))->with('good', __('section_t.Good Job!'));
    }
}
