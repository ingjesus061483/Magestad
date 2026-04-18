<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateHomework extends Model
{
    use HasFactory;
    protected $table='state_homework';
    public function homeworks()
    {
        return $this->hasMany(Homework::class,'state_homework_id');
    }
}
