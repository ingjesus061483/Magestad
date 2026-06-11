<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loan\StoreRequest;
use App\Http\Requests\Loan\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Loan;
class LoanController extends Controller
{
    public function update(UpdateRequest $request,int $id)
    {
        $loan=Loan::find($id);
       // $ammount=$this->convert_to_number($request->ammount);
        $arrloan=[
            'ammount'=>$request->ammount,
            'term'=>$request->term,
            'client_id'=>$request->client_id,
            'warranty_id'=>$request->warranty,
            'loan_type_id'=>$request->loan_type,

        ];
        $loan->update($arrloan);
        session(["info"=>"6"]);
        return back()->with(['message'=>'Información del prestamo actualizada correctamente']);
    }
    public function store(StoreRequest $request)
    {
        $client=session()->has('client')?session('client'):null;
        $day_request=loan::whereraw("DATE_FORMAT(created_at, '%Y-%m-%d')=DATE_FORMAT(curdate(),'%Y-%m-%d')")
                         ->where('loan_status_id','=',1)
                         ->count()+1;
      //  $ammount=$this->convert_to_number($request->ammount);
        if($client==null)
        {
            return redirect()->to(url('/clients/create'))  ->withErrors("La información personal no ha
                                                                         sido llena");
        }
        $arrloan=[
            'reference'=>'SC-'.$client->identification.'-'.$day_request,
            'ammount'=>$request->ammount,
            'term'=>$request->term,
            'client_id'=>$request->client_id,
            'warranty_id'=>$request->warranty,
            'loan_type_id'=>$request->loan_type,
            'loan_status_id'=>1,
        ];
        $loan=Loan::create($arrloan);
        session(["info"=>"7"]);
        return redirect()->to(url('/clients/create'))
                         ->with(['message'=>'Solicitud de credito generada correctamente. Continue con el tratamiento de datos personales.']);

    }
    //
}
