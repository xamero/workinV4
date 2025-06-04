<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantProfileLicenseEligibilities extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $fillable = ['name', 'issuer', 'date_of_issuance', 'date_of_expiration', 'description'];

//    protected function casts(): array
//    {
//        return [
//            'date_of_issuance' => 'date',
//            'date_of_expiration' => 'date',
//        ];
//    }

    public function getDateOfIssuanceAttribute($value)
    {

        return $value ? Carbon::parse($value): null;
    }
//
//    // Example for parsing and formatting the 'date_of_expiration' attribute
    public function getDateOfExpirationAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

}
