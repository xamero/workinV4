<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function Barangay()
    {
        return $this->hasMany('App\Models\Barangay');
    }

    public function Profile()
    {
        return $this->hasMany('App\Models\ApplicantProfile');
    }

}
