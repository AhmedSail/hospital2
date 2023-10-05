<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];


    public $translatedAttributes = ['name','appointments'];
/**
     * Get the Doctor's image.
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }
    function doctorappointments() {
        return $this->belongsToMany(Appointment::class);
    }
}
