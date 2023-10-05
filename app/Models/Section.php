<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model implements TranslatableContract
{
    protected $guarded=[];
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name','description'];

    public function doctors() {
        return $this->hasMany(Doctor::class);
    }
}
