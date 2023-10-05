<?php

namespace  App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface{

    public function index();
    public function show($id);
    public function review_invoices();
    public function complete_invoices();
    public function showLaboratorie($id);

}

