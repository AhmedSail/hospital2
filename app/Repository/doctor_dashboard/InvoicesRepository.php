<?php

namespace App\Repository\doctor_dashboard ;

use App\Models\Ray;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Doctor;
use App\Models\Laboratory;

class InvoicesRepository implements InvoicesRepositoryInterface{

    //تحت الاجراء
    public function index(){
        $invoices=Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',1)->get();
        return view('Dashboard.Doctor.invoices.index',compact('invoices'));
    }
    public function show($id){
        $rays=Ray::find($id);
        return view('Dashboard.Doctor.invoices.view_rays',compact('rays'));
    }
    //تحت المراجعة
    public function review_invoices(){
        $invoices=Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',2)->get();
        return view('Dashboard.Doctor.invoices.review_invoices',compact('invoices'));
    }
    //مكتملة
    public function complete_invoices(){
        $invoices=Invoice::where('doctor_id',Auth::user()->id)->where('invoice_status',3)->get();
        return view('Dashboard.Doctor.invoices.complete_invoices',compact('invoices'));
    }
    public function showLaboratorie($id)
    {
        $laboratories = Laboratory::findorFail($id);
        if($laboratories->doctor_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
    }

}
