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
        session(["info"=>"5"]);
        return back()->with(['message'=>'Información del prestamo actualizada correctamente']);
    }
    public function store(StoreRequest $request)
    {
        $client=session()->has('client')?session('client'):null;
      //  $ammount=$this->convert_to_number($request->ammount);
        if($client==null)
        {
            return redirect()->to(url('/clients/create'))  ->withErrors("La información personal no ha
                                                                         sido llena");
        }
        $arrloan=[
            'reference'=>'SC-'. $client->identification.'-'.$client->id,
            'ammount'=>$request->ammount,
            'term'=>$request->term,
            'client_id'=>$request->client_id,
            'warranty_id'=>$request->warranty,
            'loan_type_id'=>$request->loan_type,
            'loan_status_id'=>3,
        ];
        $loan=Loan::create($arrloan);
        session(["info"=>"6"]);
        return redirect()->to(url('/clients/create'))
                         ->with(['message'=>'Solicitud de credito generada correctamente. Continue con el tratamiento de datos personales.']);

    }
    //
}
