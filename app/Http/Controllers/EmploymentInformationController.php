<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmploymentInformation\StoreRequest;
use App\Http\Requests\EmploymentInformation\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\EmploymentInformation;
class EmploymentInformationController extends Controller
{
    public function update(UpdateRequest $request , int $id)
    {
        $EmploymentInformation=EmploymentInformation::find($id);
      //  $average_monthly_salary=$this->convert_to_number($request->average_monthly_salary);
        $arrEmployment=[
            'occupational_position_id'=>$request->occupational_position,
            'nit_company_work'=>$request->nit_company_works,
            'company_works'=>$request->company_works,
            'main_address'=>$request->main_address,
            'city_id'=>$request->city,
            'state_id'=>$request->state,
            'company_on_mission'=>$request->company_on_mission,
            'nit'=>$request->nit_company_on_mission,
            'branch_address'=>$request->address_company_on_mission,
            'entry_date'=>$request->entry_date,
            'average_monthly_salary'=>$request->average_monthly_salary,
            'current_position'=>$request->current_position,
            'client_id'=> $request->client_id,
            'payment_frequency_id'=>$request->payment_frequency,
            'company_payment_date_id'=>$request->company_payment_date,
            'customer_payment_date_id'=>$request->custemer_payment_date,
            'contract_type_id'=>$request->contract_type,
            'eps_affiliate_id'=>$request->eps_affiliate,
            'arl_affiliate_id'=>$request->arl_affiliate
        ];
        $EmploymentInformation->update($arrEmployment);
        session(["info"=>"2"]);
        return back()->with(['message'=>'Información de empleo actualizada correctamente']);
    }
    public function store(StoreRequest $request)
    {
        $client=session()->has('client')?session('client'):null;
        if($client==null)
        {
            return redirect()->to(url('/clients/create'))  ->withErrors("la informacion personal no ha sido llena");
        }
     //   $average_monthly_salary=$this->convert_to_number($request->average_monthly_salary);
        $arrEmployment=[
            'occupational_position_id'=>$request->occupational_position,
            'nit_company_work'=>$request->nit_company_works,
            'company_works'=>$request->company_works,
            'main_address'=>$request->main_address,
            'city_id'=>$request->city,
            'state_id'=>$request->state,
            'company_on_mission'=>$request->company_on_mission,
            'nit'=>$request->nit_company_on_mission,
            'branch_address'=>$request->address_company_on_mission,
            'entry_date'=>$request->entry_date,
            'average_monthly_salary'=>$request->average_monthly_salary,
            'current_position'=>$request->current_position,
            'client_id'=> $request->client_id,
            'payment_frequency_id'=>$request->payment_frequency,
            'company_payment_date_id'=>$request->company_payment_date,
            'customer_payment_date_id'=>$request->custemer_payment_date,
            'contract_type_id'=>$request->contract_type,
            'eps_affiliate_id'=>$request->eps_affiliate,
            'arl_affiliate_id'=>$request->arl_affiliate
        ];
        $EmploymentInformation=EmploymentInformation::create($arrEmployment);
        session(["info"=>"4"]);
        return back()->with(['message'=>'Información de empleo guardada correctamente. Continua con la informacion patrimonial.']);
    }
    //
}
