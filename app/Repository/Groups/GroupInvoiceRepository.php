<?php

namespace App\Repository\Groups;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Service;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Interfaces\Groups\GroupInvoiceRepositoryInterface;
use App\Models\Group;
use App\Models\Invoice;

class GroupInvoiceRepository implements GroupInvoiceRepositoryInterface
{
    public function index()
    {
        $Groups = Invoice::where('invoice_type',2)->get();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.Groups.index', compact('Groups', 'Patients', 'Doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Groups = Group::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.Groups.add', compact('Groups', 'Patients', 'Doctors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Patients' => ['required'],
            'Doctors' => ['required'],
            'Groups' => ['required'],
            'type_of_invoice' => ['required'],
        ]);
        if ($request->type_of_invoice == 1) {
            //Save to Invoices table
            $Groups = Invoice::create([

                'invoice_type'=>2,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'group_id' => $request->Groups,
                'type' => $request->type_of_invoice,
                'section_id' => $request->Sections,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $request->tax_value,
                'total_with_tax' => $request->total_with_tax,
                'invoice_status'=>1,

            ]);
            //Save to FundAccount table
            FundAccount::create([
                'date' => now(),
                'invoice_id' => $Groups->id,
                'debit' => $Groups->total_with_tax,
                'credit' => 0.00
            ]);
        } else {
            $Groups = Invoice::create([
                'invoice_type'=>2,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'group_id' => $request->Groups,
                'type' => $request->type_of_invoice,
                'section_id' => $request->Sections,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $request->tax_value,
                'total_with_tax' => $request->total_with_tax,
                'invoice_status'=>1,
            ]);
            PatientAccount::create([
                'date' => now(),
                'invoice_id' => $Groups->id,
                'patient_id' => $Groups->Patient->id,
                'debit' => $Groups->total_with_tax,
                'credit' => 0.00

            ]);
        }

        if ($Groups) {
            return redirect()->route('GroupInvoices.index')->with('msg', __('invoices.Invoice Add Successfully'))->with('good', __('section_t.Good Job!'));
        }else{
            return redirect()->route('GroupInvoices.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Group = Invoice::find($id);
        $Groups=Group::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.Groups.edit', compact('Group', 'Patients', 'Doctors','Groups'));
    }
    public function show($id)
    {
        $Group = Invoice::find($id);
        $Groups=Group::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.Groups.print', compact('Group', 'Groups', 'Patients', 'Doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Group = Invoice::find($id);
        $fundAccount = FundAccount::where('invoice_id',$Group->id)->first();
        $patientAccount = PatientAccount::where('invoice_id',$Group->id)->first();
        if (!empty($request->Doctors)) {
            $selectedDoctor = Doctor::find($request->Doctors);
            $sectionId = $selectedDoctor->section->id;
        } else {
            $sectionId = $request->Sections;
        }
        $request->validate([
            'Patients' => ['required'],
            'Doctors' => ['required'],
            'Groups' => ['required'],


        ]);
        if ($Group->type==1) {
            $Group->update([
                'invoice_type'=>2,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'group_id' => $request->Groups,
                'type' => $Group->type,
                'section_id' => $sectionId,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $request->tax_value,
                'total_with_tax' => $request->total_with_tax,
                'invoice_status'=>1,
            ]);
            $fundAccount->update([
                'date' => now(),
                'invoice_id' => $Group->id,
                'debit' => $Group->total_with_tax,
                'credit' => 0.00
            ]);
        }else{
            $Group->update([
                'invoice_type'=>2,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'group_id' => $request->Groups,
                'type' => $Group->type,
                'section_id' => $sectionId,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $request->tax_value,
                'total_with_tax' => $request->total_with_tax,
                'invoice_status'=>1,
            ]);
            $patientAccount->update([
                'date' => now(),
                'invoice_id' => $Group->id,
                'patient_id' => $Group->Patient->id,
                'debit' => $Group->total_with_tax,
                'credit' => 0.00
            ]);
        }
        if ($Group) {
            return redirect()->route('GroupInvoices.index')->with('msg', __('invoices.Invoice Updated Successfully'))->with('good', __('section_t.Good Job!'));
        }else{
            return redirect()->route('Invoices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $Group = Invoice::find($id)->delete();
        return redirect()->route('GroupInvoices.index')->with('msg', __('invoices.Invoice Deleted Successfully'))->with('good', __('section_t.Good Job!'));
    }
}
