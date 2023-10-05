<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}