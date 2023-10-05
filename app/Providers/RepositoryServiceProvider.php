<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Services\GroupRepository;
use App\Repository\Finance\PaymentRepository;
use App\Repository\Finance\ReceiptRepository;
use App\Repository\Invoices\InvoiceRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Ambulance\AmbulanceRepository;
use App\Repository\Groups\GroupInvoiceRepository;
use App\Repository\Insurance\InsuranceRepository;
use App\Repository\doctor_dashboard\RayRepository;
use App\Repository\Services\SingleServiceRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Services\GroupRepositoryInterface;
use App\Repository\Laboratory\LaboratoriesRepository;
use App\Repository\RayEmployee\RayEmployeeRepository;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\Invoices\InvoiceRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Repository\doctor_dashboard\InvoicesRepository;
use App\Repository\doctor_dashboard\DiagnosisRepository;
use App\Repository\doctor_dashboard\LaboratoryRepository;
use App\Repository\RayEmployee\InvoiceEmpolyeeRepository;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Interfaces\Groups\GroupInvoiceRepositoryInterface;
use App\Interfaces\Insurance\InsuranceRepositoryInterface;
use App\Interfaces\doctor_dashboard\RayRepositoryInterface;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Interfaces\Laboratory\LaboratoriesRepositoryInterface;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Repository\patient_dashboard\PatientDashboardRepository;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Interfaces\doctor_dashboard\LaboratoryRepositoryInterface;
use App\Interfaces\RayEmployee\InvoiceEmpolyeeRepositoryInterface;
use App\Repository\LaboratoryEmployee\LaboratoryEmployeeRepository;
use App\Interfaces\patient_dashboard\PatientDashboardRepositoryInterface;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //admin
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(GroupInvoiceRepositoryInterface::class, GroupInvoiceRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);
        //doctor
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        $this->app->bind(DiagnosisRepositoryInterface::class, DiagnosisRepository::class);
        $this->app->bind(RayRepositoryInterface::class, RayRepository::class);
        $this->app->bind(LaboratoryRepositoryInterface::class, LaboratoryRepository::class);
        //employee
        $this->app->bind(InvoiceEmpolyeeRepositoryInterface::class, InvoiceEmpolyeeRepository::class);
        //laboratory
        $this->app->bind(LaboratoriesRepositoryInterface::class, LaboratoriesRepository::class);
        $this->app->bind(LaboratoryEmployeeRepositoryInterface::class, LaboratoryEmployeeRepository::class);
        //patient
        $this->app->bind(PatientDashboardRepositoryInterface::class, PatientDashboardRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
