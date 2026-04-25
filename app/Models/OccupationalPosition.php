<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationalPosition extends Model
{
    use HasFactory;
    public function employment_informations(){
        return $this->hasMany(EmploymentInformation::class,'occupational_position_id');
    }
}
