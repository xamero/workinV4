<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory;

//    use SoftDeletes;
    use Notifiable;

    protected $fillable = ['name','address', 'email', 'contact_number','company_overview'];

    /**
     * Get the user that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function recruitmentActivities()
    {
        return $this->belongsToMany(RecruitmentActivity::class);
    }
}
