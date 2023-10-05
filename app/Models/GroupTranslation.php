<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTranslation extends Model
{
    use HasFactory;
    protected $guarded=[];
    // public $translatedAttributes = ['name','notes'];
    public $timestamps=false;
}
