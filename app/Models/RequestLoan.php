<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'clientName',
        'amountRequested',
        'priority_id',
        'comments'
    ];
    public function priorities(){
        return $this->belongsTo(Priority::class,'priority_id');
    }
}
