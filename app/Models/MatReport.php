<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'mat_report_detail_id',
        'company_id',
        'file_path',
        'submitted_at',
        'status',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reportDetails()
    {
        return $this->belongsTo(MatReportDetails::class, 'mat_report_detail_id');
    }
}
