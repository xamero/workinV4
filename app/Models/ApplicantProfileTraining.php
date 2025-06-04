<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantProfileTraining extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $fillable = ['name', 'date_start', 'date_end', 'institution', 'certificate'];

    protected $casts = [
        'date_start' => 'datetime:Y-m-d',
        'date_end' => 'datetime:Y-m-d',
    ];

    public function getDateStartAttribute($value)
    {

        return $value ? Carbon::parse($value): null;
    }
    public function getDateEndAttribute($value)
    {

        return $value ? Carbon::parse($value): null;
    }


}
