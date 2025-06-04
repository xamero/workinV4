<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCityMunicipality extends Model
{
    use HasFactory;

    public function province(){
        return $this->belongsTo(AddressProvince::class);
    }
}
