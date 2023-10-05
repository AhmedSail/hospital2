<?php

namespace App\Repository\Invoices;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\single_invoice;
use App\Interfaces\Invoices\InvoiceRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\PatientAccount;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index()
    {
        $single_invoices =Invoice::where('invoice_type',1)->get();
        $Services = Service::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.single-invoices.index', compact('single_invoices', 'Services', 'Patients', 'Doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tax_value = 0;
        $single_invoices = Invoice::all();
        $Services = Service::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.single-invoices.single-invoices', compact('Services', 'Patients', 'Doctors', 'tax_value'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Patients' => ['required'],
            'Doctors' => ['required'],
            'Services' => ['required'],
            'type_of_invoice' => ['required'],
            'dis_value' => ['required'],
            'tax_rate' => ['required'],
        ]);
        $Total_after_discount = $request->priceInput - $request->dis_value;
        $tax_value = $Total_after_discount * ((is_numeric($request->tax_rate) ? $request->tax_rate : 0) / 100);
        $total_with_tax = $request->priceInput -  $request->dis_value + $tax_value;
        if ($request->type_of_invoice == 1) {
            //Save to Invoices table
            $invoice = Invoice::create([
                'invoice_type'=>1,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'service_id' => $request->Services,
                'type' => $request->type_of_invoice,
                'section_id' => $request->Sections,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $tax_value,
                'total_with_tax' => $total_with_tax,
                'invoice_status'=>1,
            ]);
            //Save to FundAccount table
            FundAccount::create([
                'date' => now(),
                'invoice_id' => $invoice->id,
                'debit' => $invoice->total_with_tax,
                'credit' => 0.00
            ]);
        } else {
            $invoice = Invoice::create([
                'invoice_type'=>1,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'service_id' => $request->Services,
                'type' => $request->type_of_invoice,
                'section_id' => $request->Sections,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $tax_value,
                'total_with_tax' => $total_with_tax,
                'invoice_status'=>1,
            ]);
            PatientAccount::create([
                'date' => now(),
                'invoice_id' => $invoice->id,
                'patient_id' => $invoice->Patient->id,
                'debit' => $invoice->total_with_tax,
                'credit' => 0.00

            ]);
        }

        if ($invoice) {
            return redirect()->route('Invoices.index')->with('msg', __('invoices.Invoice Add Successfully'))->with('good', __('section_t.Good Job!'));
        }else{
            return redirect()->route('Invoices.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $single_invoices = Invoice::find($id);
        $tax_value = 0;
        $Services = Service::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.single-invoices.edit', compact('single_invoices', 'Services', 'Patients', 'Doctors', 'tax_value'));
    }
    public function show($id)
    {
        $single_invoices = Invoice::find($id);
        $tax_value = 0;
        $Services = Service::all();
        $Patients = Patient::all();
        $Doctors = Doctor::all();
        return view('Dashboard.Invoices.single-invoices.print', compact('single_invoices', 'Services', 'Patients', 'Doctors', 'tax_value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $single_invoices = Invoice::find($id);
        $fundAccount = FundAccount::where('invoice_id',$single_invoices->id)->first();
        $patientAccount = PatientAccount::where('invoice_id',$single_invoices->id)->first();
        if (!empty($request->Doctors)) {
            $selectedDoctor = Doctor::find($request->Doctors);
            $sectionId = $selectedDoctor->section->id;
        } else {
            $sectionId = $request->Sections;
        }
        $Total_after_discount = $request->priceInput - $request->dis_value;
        $tax_value = $Total_after_discount * ((is_numeric($request->tax_rate) ? $request->tax_rate : 0) / 100);
        $total_with_tax = $request->priceInput -  $request->dis_value + $tax_value;
        $request->validate([
            'Patients' => ['required'],
            'Doctors' => ['required'],
            'Services' => ['required'],
            // 'type_of_invoice' => ['required'],
            'dis_value' => ['required'],
            'tax_rate' => ['required'],


        ]);
        if ($single_invoices->type==1) {
            $single_invoices->update([
                'invoice_type'=>1,
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'service_id' => $request->Services,
                'type' => $single_invoices->type,
                'section_id' => $sectionId,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $tax_value,
                'total_with_tax' => $total_with_tax,
                'invoice_status'=>1,
            ]);
            $fundAccount->update([
                'date' => now(),
                'invoice_id' => $single_invoices->id,
                'debit' => $single_invoices->total_with_tax,
                'credit' => 0.00
            ]);
        }else{
            $single_invoices->update([
                'invoice_date' => now(),
                'doctor_id' => $request->Doctors,
                'patient_id' => $request->Patients,
                'service_id' => $request->Services,
                'type' => $single_invoices->type,
                'section_id' => $sectionId,
                'price' => $request->priceInput,
                'discount_value' => $request->dis_value,
                'tax_rate' => $request->tax_rate,
                'tax_value' => $tax_value,
                'total_with_tax' => $total_with_tax,
            ]);
            $patientAccount->update([
                'date' => now(),
                'invoice_id' => $single_invoices->id,
                'patient_id' => $single_invoices->Patient->id,
                'debit' => $single_invoices->total_with_tax,
                'credit' => 0.00
            ]);
        }
        if ($single_invoices) {
            return redirect()->route('Invoices.index')->with('msg', __('invoices.Invoice Updated Successfully'))->with('good', __('section_t.Good Job!'));
        }else{
            return redirect()->route('Invoices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $single_invoices = Invoice::find($id)->delete();
        return redirect()->route('Invoices.index')->with('msg', __('invoices.Invoice Deleted Successfully'))->with('good', __('section_t.Good Job!'));
    }
}
