<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function Patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function Laboratory_Employee(){
        return $this->belongsTo(LaboratoryEmployee::class,'employee_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
