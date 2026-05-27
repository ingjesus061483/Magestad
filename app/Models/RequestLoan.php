<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'client_id',
        'amountRequested',
        'priority_id',
        'comments'
    ];
    public function priorities(){
        return $this->belongsTo(Priority::class,'priority_id');

    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}
