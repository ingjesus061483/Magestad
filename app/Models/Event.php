<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected  $fillable=[
               'event_type_id','title','date','time','remark'
    ];
    public function event_type()
    {
        return $this->belongsTo(EventType::class,'event_type_id');

    }

}
