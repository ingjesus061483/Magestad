<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    public function requestLoans(){
        return $this->hasMany(RequestLoan::class,'priority_id');
    }

}
