<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentActivity extends Model
{
    use HasFactory;

    protected $fillable = ['type','start','end','venue','details'];


    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
