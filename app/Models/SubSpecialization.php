<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSpecialization extends Model
{
    use HasFactory;

    /**
     * Get the ApplicantProfile that owns the SubSpecialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ApplicantProfile()
    {
        return $this->belongsToMany(ApplicantProfile::class);
    }
}
