<?php

namespace App\Models;

use App\Livewire\Applicant\Profile\WorkExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantProfile extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'birthday' => 'date:Y-m-d',
        ];
    }

    public function job_application()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function city()
    {
        return $this->belongsTo('App\Models\AddressCityMunicipality');
    }
    public function barangay()
    {
        return $this->belongsTo('App\Models\AddressBarangay');
    }

    /**
     * Get the SubSpecialization that owns the ApplicantProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function SubSpecialization()
    {
        return $this->belongsToMany(SubSpecialization::class);
    }

    /**
     * The application that belong to the ApplicantProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function application()
    {
        return $this->belongsToMany(Vacancy::class)->withPivot('applied_at', 'cover_letter', 'resume', 'access_code', 'status')->orderBy('pivot_applied_at', 'desc');
    }

    /**
     * Get the user that owns the ApplicantProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
     * get the work experience
     */
    public function experience()
    {
        return $this->hasMany(ApplicantProfileWorkExperience::class, 'personal_profile_id', 'id');
    }

    public function education()
    {
        return $this->hasMany(ApplicantProfileEducationalBackground::class, 'applicant_profile_id', 'id');
    }

    public function training()
    {
        return $this->hasMany(ApplicantProfileTraining::class, 'applicant_profile_id', 'id');

    }

    public function eligibility()
    {
        return $this->hasMany(ApplicantProfileLicenseEligibilities::class, 'applicant_profile_id', 'id');
    }



}
