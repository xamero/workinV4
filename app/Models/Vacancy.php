<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['company_id','title','details','sub_specialization_id', 'job_type','location', 'salary_from', 'salary_to','total_vacancy'];



    public function job_application()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * The applicantProfile that belong to the Vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function applicantProfile()
    {
        return $this->belongsToMany(ApplicantProfile::class)->withPivot('applied_at', 'cover_letter', 'resume', 'access_code', 'status');
    }

    /**
     * Get the subSpecialization that owns the Vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subSpecialization()
    {
        return $this->belongsTo(SubSpecialization::class);
    }
}
