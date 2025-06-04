<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantProfileWorkExperience extends Model
{
    use HasFactory;
//    use SoftDeletes;


    public function getDateStartedAttribute($value)
    {

        return $value ? Carbon::parse($value): null;
    }

    public function getDateEndedAttribute($value)
    {

        return $value ? Carbon::parse($value): null;
    }
//


    public function applicantProfile()
    {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
