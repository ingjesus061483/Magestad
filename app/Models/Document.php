<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_type_id',
        'name',
        'path',
        'description',
        'client_id'
    ];
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function document_type(){
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }
}
