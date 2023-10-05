<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];
    public $translatedAttributes = ['name','notes'];
    
    public function service_group()
    {
        return $this->belongsToMany(Service::class,'service_group');
    }
}
