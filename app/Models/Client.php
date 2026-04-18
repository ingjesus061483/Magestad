<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected   $fillable = [
        'identification',
        'name_last_name',
        'address',
        'email',
        'city_id',
        'reference',
        'value_Title',
        'date_birth',
        'expedition_date',
        'neighborhood',
        'vehicle',
        'estate',
        'seizure',
        'company_seizure',
        'quality_holder_id',
        'marital_status_id',
        'level_study_id'
    ];
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function Marital_Status()
    {
        return $this->belongsTo(MaritalStatus::class,'marital_status_id');
    }
    public function quality_holder()
    {
        return $this->belongsTo(QualityHolder::class,'quality_holder_id');
    }
    public function level_study()
    {
        return $this->belongsTo(LevelStudy::class,'level_study_id');
    }
    public function contact_informations()
    {
        return $this->hasMany(ContactInformation::class ,'client_id');
    }
    public function employment_informations()
    {
        return $this ->hasMany(EmploymentInformation::class,'client_id');
    }
    public function loans()
    {
        return $this ->hasMany(Loan::class,'client_id');
    }
    public function client_policies()
    {
        return $this ->hasMany(ClientPolicy::class,'client_id');
    }
    public function documents()
    {
        return $this ->hasMany(Document::class,'client_id');
    }

}
