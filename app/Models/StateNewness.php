<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateNewness extends Model
{
    use HasFactory;
    protected $table="state_newness";
    function newnesses(){
        return $this->hasMany(Newness::class,'state_newness_id');
    }
}
