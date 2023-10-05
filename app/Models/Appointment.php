<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];
    public $translatedAttributes = ['name'];
    function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
