<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentInformation extends Model
{
    use HasFactory;
    protected $table='employment_informations';
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    protected $fillable=[

        'id',
        'nit_company_work',
        'company_works',
        'main_address',
        'city_id',
        'company_on_mission',
        'nit',
        'branch_address',
        'entry_date',
        'average_monthly_salary',
        'current_position',
        'state_id',
        'client_id',
        'payment_frequency_id',
        'company_payment_date_id',
        'customer_payment_date_id',
        'contract_type_id',
        'eps_affiliate_id',
        'arl_affiliate_id' ,
        'occupational_position_id'
    ];
    public function occupational_position()
    {
        return $this->belongsTo(OccupationalPosition::class,'occupational_position_id');

    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function payment_frequency(){
        return $this->belongsTo(PaymentFrecuency::class,'payment_frequency_id');
    }
    public function company_payment_date(){
        return $this->belongsTo(CompanyPaymentDate::class,'company_payment_date_id');
    }
    public function customer_payment_date(){
        return $this->belongsTo(CustomerPaymentDate::class,'customer_payment_date_id');
    }
    public function contract_type(){
        return $this->belongsTo(ContractType::class,'contract_type_id');
    }
    public function eps_affiliate(){
        return $this->belongsTo(EpsAffiliate::class,'eps_affiliate_id');
    }
    public function arl_affiliate(){
        return $this->belongsTo(ArlAffiliate::class,'arl_affiliate_id');
    }

}
