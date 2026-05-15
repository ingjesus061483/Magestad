<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInfo\StoreRequest;
use App\Models\Client;
use App\Models\ContactInformation;
use App\Models\PhoneType;

class ContactInfoController extends Controller
{
    public function store(StoreRequest $request)
    {
        $client=(session()->has('client')?session('client'):$request->client_id!=0)?Client::find($request->client_id): null;
        $action=$request->action;
        if($client==null)
        {
            return back()->withErrors("la informacion personal no ha sido llena");
        }
//print_r($request->all());

        if($action=="Siguiente")
        {
            session(["info"=>"3"]);
            return back()->with(['message'=>'Has finalizado con exito la información de contacto.\n Continua con la información laboral.']);
        }
        else if($action=="Guardar")
        {
            $ContactInfo=new ContactInformation();
            $ContactInfo->client_id=$request->client_id;
            $ContactInfo->phone_number=$request->phone;
            $ContactInfo->phone_type_id=$request->phone_type;
            $ContactInfo->save();
            session(["info"=>"2"]);
            return back()->with(['message'=>'Información de contacto creada correctamente. Si deeseas agregar más información de contacto, hazlo ahora. De lo contrario, pulsa el botón "Siguiente" para continuar.']);
        }
   }
    public function destroy(int $id)
    {
        $ContactInfo=ContactInformation::find($id);
        $ContactInfo->delete();
        session(["info"=>"2"]);
        return back()->with(['message'=>'Información de contacto eliminada correctamente']);
    }
    //
}
