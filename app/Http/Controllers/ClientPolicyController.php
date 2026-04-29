<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClientPolicy\StoreRequest;
use App\Models\AuthorizationPolicy;
use App\Models\ClientPolicy;
use App\Models\Loan;
use Illuminate\Http\Request;
class ClientPolicyController extends Controller
{
    protected $ClientpolicyAut;
    public function __construct()
    {
        $this->ClientpolicyAut=ClientPolicy::join('authorization_policies as p','p.id','=','policy_id');
    }

    function SearchPolicyClient(Request $request){
        $search=ClientPolicy::where('client_id',$request->client_id)
        ->where('policy_id',$request->policy_id)->first();
        return response()->json($search);
    }
public function store(StoreRequest $request)
{
    $title=$request->title;
    $Clientpolicies=json_decode($request->policyClients,true);
    ClientPolicy::insert($Clientpolicies);
    $message='';
    if($title=='P')
    {
        $sesion="8";
        $message='has registrado todas las politicas. Ahora es necesario completar las autorizaciones';
    }
    else if($title=='A')
    {
        $sesion="";
        $message='has registrado todas las autorizaciones. ahora pulsa el boton enviar solicitud para terminar el proceso';

    }
    session(["info"=>$sesion]);
    return response()->json(["message"=>$message,"info"=>$sesion]);
}
   /* public function store(StoreRequest $request)
    {
        $sesion="";
        $Clientpolicy=Clientpolicy::create([
            'client_id' => $request->client_id,
            'policy_id' => $request->policy_id,
            'state_policy_id' =>$request->state_policy_id,
        ]);
        $policy=$Clientpolicy->policy()->where('title','like','p%')->first();
        $autorization=$Clientpolicy->policy()->where('title','like','a%')->first();
        $parr=$policy!=null?'política '.$policy->title:($autorization!=null?'autorización '.$autorization->title:'');
        $message="";
        switch($Clientpolicy->state_policy_id)
        {
            case 1:{
                $message="La $parr ha sido aceptada. ";
                break;
            }
            case 2:{
                $message="La $parr ha sido rechazada. ";
                break;
            }
            case 3:{
                $message="En caso de no aceptar ni rechazar la $parr, comuniquese con el administrador para más información. ";
                break;
            }
        }
        if($policy!=null)
        {
            $sesion="7";
            $policies=$this->ClientpolicyAut->where('title','like','p%')
                                            ->where('client_id','=',$request->client_id)
                                            ->count();
            if($policies==AuthorizationPolicy::where('title','like','p%')->count())
            {
                $sesion="8";
                $message=$message.'. Ahora es necesario completar las autorizaciones';
            }
        }
        else if($autorization!=null)
        {
           $sesion="8";
           $autorizations=$policies=$this->ClientpolicyAut->where('client_id','=',$request->client_id)->
           where('title','like','a%')->count();
           if($autorizations==AuthorizationPolicy::where('title','like','a%')->count())
           {
                $sesion="";
               $message= $message.'ahora pulsa el boton enviar solicitud para terminar el proceso';
           }
        }
        session(["info"=>$sesion]);
        return back()->with(["message"=>$message]);
        //
    }*/


    //
}
