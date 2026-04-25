<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationPolicy;
use App\Models\ClientPolicy;
use App\Models\Document;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $client=session()->has('client')?session('client'):null;


        if($client==null){
            return view('Home.welcome');
        }
        $policy=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'p%')->where('client_id',$client?->id)->count();

        $autorization=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'a%')->where('client_id',$client?->id)->count();
         if($client->contact_informations->count()==0)
        {
               session(["info"=>"1"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información personal no ha sido completada");
        }
        else if($client->employment_informations->count()==0)
        {
             session(["info"=>"2"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información laboral no ha completada");
        }
        else if($client->loans->count()==0 && $client->quality_holder_id==1)
        {
            session(["info"=>"5"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información de préstamos no ha sido completada");
        }
        else if($policy<AuthorizationPolicy::where('title','like','p%')->count() )
        {
            session(["info"=>"7"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información de políticas no ha sido completada");
        }
        else if($autorization<AuthorizationPolicy::where('title','like','a%')->count())
        {
             session(["info"=>"8"]);
             return redirect()->to(url('/clients/create'))->
             withErrors("La información de autorizaciones no ha sido completada");
        }
        if(session()->has('client'))
        {
            session()->forget('client');
        }
        if (session()->has('info'))
        {
            session()->forget('info');
        }
         if (session()->has('message'))
        {
            session()->forget('message');
        }
        return view('Home.welcome');
    }
    //
}
