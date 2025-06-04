<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantProfileEducationalBackground extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $fillable  = ['level', 'course', 'school', 'year_graduated', 'highlights'];

    public function applicantProfile()
    {
        return $this->belongsTo(ApplicantProfile::class);
    }
}
