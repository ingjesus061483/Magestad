<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newness extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','date','client','newness_type_id','remark','state_newness_id'
    ];
    public function user (){
        return $this->belongsTo(User::class,'user_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function newness_type(){
        return $this->belongsTo(NewnessType::class,'newness_type_id');
    }
    public function state_newness(){
        return $this->belongsTo(StateNewness::class,'state_newness_id');
    }
}
