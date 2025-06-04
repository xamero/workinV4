<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatReportDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'deadline',
        'deadline_extension',
        'report_type',
        'message',
        'title'
    ];
}
