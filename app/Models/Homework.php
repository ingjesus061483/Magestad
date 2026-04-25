<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected$fillable = [
        'user_id',
        'date',
        'client',
        'remark',
        'state_homework_id',
        'homework_type_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function state_homework(){
        return $this->belongsTo(StateHomework::class,'state_homework_id');
    }
    public function homework_type(){
        return $this->belongsTo(HomeworkType::class,'homework_type_id');
    }
}
