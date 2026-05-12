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
        if($client==null)
        {
            return back()->withErrors("la informacion personal no ha sido llena");
        }
        $ContactInfo=new ContactInformation();
        $ContactInfo->client_id=$request->client_id;
        $ContactInfo->phone_number=$request->phone;
        $ContactInfo->phone_type_id=$request->phone_type;
        $ContactInfo->save();
        session(["info"=>"2"]);
        return back()->with(['message'=>'Información de contacto creada correctamente. Si deeseas agregar más información de contacto, hazlo ahora. De lo contrario, continua con la información laboral.']);
   }
    public function destroy(int $id)
    {
        $ContactInfo=ContactInformation::find($id);
        $ContactInfo->delete();
        session(["info"=>"1"]);
        return back()->with(['message'=>'Información de contacto eliminada correctamente']);
    }
    //
}
