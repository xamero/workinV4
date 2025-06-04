<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    /**
     * Get all of the SubSpecialization for the Specialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SubSpecialization()
    {
        return $this->hasMany(SubSpecialization::class);
    }
}
