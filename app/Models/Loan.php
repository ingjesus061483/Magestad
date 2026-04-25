<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table="loans";
    protected $fillable=[
        'id',
        'reference',
        'ammount',
        'term',
        'client_id',
        'warranty_id',
        'loan_type_id',
        'loan_status_id',

    ];
    public function client(){
      return $this ->belongsTo(Client::class,'client_id');
    }
    public function warranty(){
      return $this ->belongsTo(Warranty::class,'warranty_id');
    }

}
