<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressBarangay extends Model
{
    use HasFactory;

    public function cityMunicipality(){
        return $this->belongsTo(AddressCityMunicipality::class);
    }
}
