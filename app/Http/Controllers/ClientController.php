<?php
namespace App\Http\Controllers;
use App\Exports\ClientExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\AutorizeRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Http\Requests\Client\ShowRequest;
use App\Models\ArlAffiliate;
use App\Models\City;
use App\Models\CompanyPaymentDate;
use App\Models\ContactInformation;
use App\Models\ContractType;
use App\Models\CustomerPaymentDate;
use App\Models\EmploymentInformation;
use App\Models\EpsAffiliate;
use App\Models\LevelStudy;
use App\Models\Loan;
use App\Models\Document;
use App\Models\MaritalStatus;
use App\Models\PaymentFrecuency;
use App\Models\PhoneType;
use App\Models\QualityHolder;
use App\Models\State;
use App\Models\Warranty;
use App\Models\AuthorizationPolicy;
use App\Models\ClientPolicy;
use App\Models\DocumentType;
use App\Models\LoanType;
use App\Models\OccupationalPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{
    protected Builder $loantypes;
    protected Builder $autorizationPolicy;
    protected Builder $occupationalposition;
    protected Builder $QualityHolder;
    protected Builder $ArlAffiliates;
    protected Builder $EpsAffiliates;
    protected Builder $CompanyPaymentDates;
    protected Builder $CustomerPaymentDates;
    protected Builder $PaymentFrecuencies;
    protected Builder $ContractTypes;
    protected Builder $studylevels;
    protected Builder $maritalstatus;
    protected Builder $phonetypes;
    protected Builder $clients;
    protected Builder $Warranties;
    protected Builder $States;
    protected Builder $cities;
    protected Builder $policies;
    protected Builder $autorizations;
    protected Builder $documenttypes;
    function __construct()
    {
        $this->autorizationPolicy=AuthorizationPolicy::select('*');
        $this->occupationalposition=OccupationalPosition::select('id','name');
        $this->documenttypes=DocumentType::select('id','name');
        $this->cities=City::orderby('name','asc');
        $this->policies=AuthorizationPolicy::where('title','like','p%')->select('*');
        $this->autorizations=AuthorizationPolicy::where('title','like','A%')->select('*');
        $this-> QualityHolder=QualityHolder::orderby('name','asc');
        $this-> ArlAffiliates=ArlAffiliate::orderby('name','asc');
        $this->EpsAffiliates=EpsAffiliate::orderby('name','asc');
        $this->CompanyPaymentDates=CompanyPaymentDate::select('*');
        $this->CustomerPaymentDates=CustomerPaymentDate::select('*');
        $this->PaymentFrecuencies=PaymentFrecuency::select('*');
        $this->ContractTypes=ContractType ::orderby('name','asc');
        $this->studylevels=LevelStudy::select('*');
        $this->maritalstatus=MaritalStatus::orderby('name','asc');
        $this->phonetypes=PhoneType::orderby('name','asc');
        $this->Warranties=Warranty::orderby('name','asc');
        $this->loantypes=LoanType::select('id','name');
        $this->States=State::orderby('name','asc');
        $this->clients=$this->getClientsBuider();
    }
    public function GetClients(Request $request)
    {
        $clients=Client::select('identification')->selectRaw("reference as name")
                        ->where ('clients.reference','like','%'.$request->name.'%')
                        ->orderby('reference','asc')->get();
        return response()->json($clients);
    }
    public function SearchByName(Request $request)
    {
        $clients=Client::where('clients.reference','like','%'.$request->name.'%')
                      ->select( "id","identification")
                      ->selectRaw("reference as name")
                        ->orderby('reference','asc')
                      ->get();
        return response()->json($clients);
    }
    public function UpdateDataProccess(Request $request,int $id){
        $accept_data_treatment=$request->accept_data_treatment==null?0:(bool)$request->accept_data_treatment;
        $client=Client::find($id);
        if($client==null)
        {
            session(["info"=>"0"]);
            return response()->json()
                             ->withErrors('No se ha encontrado el cliente');
            //return redirect()->to(url('/clients/create'))
              //               ->withErrors('No se ha encontrado el cliente');
        }
        $client ->acept_data_processing_policies=$accept_data_treatment;
        $client ->update();
        $autorizationPolicies=$this->autorizationPolicy->get();
        $clientPolicies=[];
        foreach($autorizationPolicies as $item)
        {
            $clientPolicies[]=[
                "client_id"=>$id,
                "policy_id"=>$item->id,
                "state_policy_id"=>1
            ];
        }
      //  Print_r($clientPolicies);
      //  exit;
        ClientPolicy::insert($clientPolicies);
        session(["info"=>"7"]);
        session(['client' => $client]);
        return response()->json([
                            'info'=>"7",
                            "countpolicies"=>count($autorizationPolicies)
                            ]);
    }
    public function UpdateLawInformation(Request $request ,int $id)
    {
        $seizure=$request->seizure==null?0:(bool)$request->seizure;
        if($seizure==1 && ($request->company_seizure==null || trim($request->company_seizure)==""))
        {
            return redirect()->to(url('/clients/create'))
                             ->withErrors('Debe ingresar la empresa que tiene el embargo');
        }
        $client=Client::find($id);
        if($client==null)
        {
             session(["info"=>"0"]);
            return redirect()->to(url('/clients/create'))
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client->seizure=$seizure;
        $client->company_seizure=$request->company_seizure;
        $client->update();
        $message="";
if($client->quality_holder_id==1)
    {
        session(["info"=>"6"]);
        $message="Se ha actualizado la información legal. Continue con la información del crédito.";
        }
        if($client->quality_holder_id==2||$client->quality_holder_id==3)
        {
            session(["info"=>"7"]);
            $message="Se ha actualizado la información legal. Continue con las politicas";

            }

        session(['client' => $client]);
        return back() ->with(['message'=>$message]);
       // return redirect()->to(url('/clients/create'))->withInput(["client_id"=>$client->id]);
    }
    public function UpdatePatrimonialInformation(Request $request ,int $id)
    {
        $client=Client::find($id);
        if($client==null)
        {
            session(["info"=>"0"]);
            return redirect()->to(url('/clients/create'))
                             ->withInput(["client_id"=>$id])
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client->vehicle=$request->vehicle==null?0:(bool)$request->vehicle;
        $client->estate=$request->estate==null?0:(bool)$request->estate;
        $client->update();
        session(["info"=>"5"]);
        session(['client' => $client]);
      //  return redirect()->to(url('/clients/create'))->withInput(["client_id"=>$client->id]);
        return back() ->with(['message'=>'Se ha actualizado la información patrimonial. Continue con la información legal.']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        if(session()->has('client'))
        {
            session()->forget('client');
        }
        if (session()->has('info'))
        {
            session()->forget('info');
        }
        $rows_per_page=$request->rows_per_page ?? env('ROWS_PER_PAGE');
        $clients=$this->clients;
        if($request->client_id!=null){
           $clients=$this->clients->where('clients.id','=',$request->client_id);
        }
        elseif($request->loan_reference!=null){
            $clients=$this->clients->where('loans.reference','=',$request->loan_reference);
        }
        $clients = $clients->paginate($rows_per_page);
        $clients->setPath(url('/clients'));
        $data=[
            "loan_reference"=>$request->loan_reference ?? '',
            "client_id"=>$request->client_id ?? '',
            "client_name"=>$request->client ?? '',
            "rows_per_page"=>$rows_per_page,
            "clients" => $clients
        ];
        return view('Client.index', $data);
        //
    }
    public function getArray(Builder $policiesclients):array
    {
        $policies=$policiesclients->get();
        $arr=[];
        foreach($policies as $pc)
        {
            $arr[]=$pc->policy_id;
        }
        return $arr;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $arrp=[];
        $arra=[];
        $client=session()->has('client')?session('client'):null;
        $client_id=$client==null?0: $client->id;
        $documenttypes=$this->documenttypes->selectRaw("(SELECT
                                                        COUNT(id)
                                                        FROM
                                                        documents
                                                        WHERE
                                                        client_id={$client_id} and
                                                        document_type_id=`document_types`.id) amount ");
        $autorizationclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'a%')->where('client_id',$client?->id);
        $policiesclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'p%')->where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client?->id)->first();
        $loan=Loan::where('client_id',$client?->id)->first();
        $info=session()->has("info")?session('info'):'1';
        $arrp=$this->getArray($policiesclients);
        $arra=$this->getArray($autorizationclients);
        $data=[
            'autorizationPolicy'=>$this->autorizationPolicy->get(),
            'loantypes'=>$this->loantypes->get(),
            'occupationalposition'=>$this->occupationalposition->get(),
            'policiesCount'=>$this->policies->count(),
            'autorizationsCount'=>$this->autorizations->count(),
            'policies'=>$this->policies->whereNotIn ('id',$arrp)->get(),
            'autorizations'=>$this->autorizations->whereNotIn ('id',$arra)->get(),
            'policyclients'=>$policiesclients->get(),
            'autorizationsclients'=>$autorizationclients->get(),
            'client'=>$client,
            'contactInfos'=>$contactInfos->get(),
            'EmploymentInformation'=>$EmploymentInformation,
            'loan'=>$loan,
            'QualityHolder'=>$this-> QualityHolder->get(),
            'ArlAffiliates'=>$this-> ArlAffiliates->get(),
            'EpsAffiliates'=>$this-> EpsAffiliates->get(),
            'cities'=>$this->cities->get(),
            'info'=>$info,
            'CompanyPaymentDates'=>$this-> CompanyPaymentDates->get(),
            'CustomerPaymentDates'=>$this-> CustomerPaymentDates->get(),
            'PaymentFrecuencies'=>$this-> PaymentFrecuencies->get(),
            'ContractTypes'=>$this-> ContractTypes->get(),
            'maritalstatus'=>$this-> maritalstatus->get(),
            'phonetypes'=>$this-> phonetypes->get(),
            'studylevels'=>$this-> studylevels->get(),
            'Warranties'=>$this->Warranties->get(),
            'States'=>$this->States->get(),
            'documenttypes'=> $documenttypes->get(),
        ];
        return view("Client.create",$data );
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $value_title=$request->consecutive!=''? $request->letter.'-'.$request->consecutive:'';
        $arrclient=[
            'identification'=>$request->identification,
            'name_last_name'=>$request->name_last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'reference'=>$request->reference,
            'value_Title'=>$value_title,
            'date_birth'=>$request->birth_date,
            'expedition_date'=>$request->expedition_date,
            'neighborhood'=>$request->neighborhood,
            'city_id'=>$request->city_id,
            'vehicle'=>$request->vehicle==null?0:(bool)$request->vehicle ,
            'estate'=>$request->estate==null?0:(bool)$request->estate,
            'seizure'=>$request->seizure==null?0:(bool)$request->seizure,
            'quality_holder_id'=>$request->quality_holder,
            'marital_status_id'=>$request->marital_status,
            'level_study_id'=>$request->study_level
        ];
        $client = Client::create($arrclient);
        session(['client' => $client]);
        session(["info"=>"2"]);
        return redirect()->to(url('/clients/create'))->with(['message'=>'Se ha creado un cliente. Ahora  debes ingresar la información de contacto']);
        //
    }
    public function redirectToClient(Client $client )
    {
        session(['client' => $client]);
        $documenttypes=$this->documenttypes->selectRaw("(SELECT
                                                        COUNT(id)
                                                        FROM
                                                        documents
                                                        WHERE
                                                        client_id={$client?->id} and
                                                        document_type_id=`document_types`.id) amount ");
        $autorizationPolicy=AuthorizationPolicy::count();
        $policies=AuthorizationPolicy::where('title', 'like', 'p%')->count();
        $autorizations=AuthorizationPolicy::where('title', 'like', 'a%')->count();
        $documents=Document::where('client_id',$client?->id);
        $policiesclients=ClientPolicy::where('client_id',$client?->id);
        $autorizationclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'a%')->where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client?->id)->first();
        $loan=Loan::where('client_id',$client?->id)->first();
        if($client==null)
        {
            session(["info"=>"1"]);
            return redirect()->to(url('/clients/create'))->withErrors('La informacion personal no ha sido diligenciaciada')
            ->withInput(['client_id'=>$client?->id]);
        }
        if($contactInfos->count()==0)
        {
            session(["info"=>"2"]);
            return redirect()->to(url('/clients/create'))->withErrors('La informacion de contacto no ha sido diligenciaciada')
            ->withInput(['client_id'=>$client?->id]);
        }
        if($EmploymentInformation==null)
        {
            session(["info"=>"3"]);
            return redirect()->to(url('/clients/create'))->withErrors('La informacion laboral no ha sido diligenciaciada')
            ->withInput(['client_id'=>$client->id]);
        }
        if($loan==null&& $client->quality_holder_id==1)
        {
            session(["info"=>"6"]);
            return redirect()->to(url('/clients/create'))->withErrors('La informacion dl credito no ha sido diligenciado')
            ->withInput(['client_id'=>$client->id]);
        }
        if($policiesclients->count()<$autorizationPolicy)
        {
            session(["info"=>"7"]);
            return redirect()->to(url('/clients/create'))->withErrors('No has aceptado los termino y condiciones')
            ->withInput(['client_id'=>$client->id]);
        }
        $data =
        [
            'documenttypes'=> $documenttypes->get(),
            'policiesclients'=> $policiesclients->get(),
            'autorizationclients'=> $autorizationclients->get(),
            'client'=> $client
        ];
        if(request()->action=="finish")
        {
            $message="";
            if($loan!=null)
            {
                $message="Su solicitud de credito ha sido enviada con referencia
                              $loan->reference. a continuacion estaremos enviando un
                              correo con los pasos a seguir de esta soicitud";
            }
            else
            {
                $message="Su solicitud de credito ha sido enviada.
                              A continuacion estaremos enviando un
                              correo con los pasos a seguir de esta soicitud";
            }
            session([ 'message'=>$message]);
                              return view('Client.finish',$data);
        }
        session(['client' => $client]);
        return view('Client.show',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id,ShowRequest $request)
    {
        if($request-> has('identification'))
        {
            $client=Client::where('identification','=',$request->identification)->first();
           /* if($client==null)
            {
                session(["info"=>"1"]);
                return redirect()->to(url('/clients/create'))->withErrors('No se ha encontrado un cliente
                                                                        con la identificación ingresada');
            }*/
            return $this-> redirectToClient($client);
        }
        $client=session()->has('client')?session('client'):null;
        if($client!=null)
        {
           return $this-> redirectToClient($client);
        }
        $client=Client::find($id);
        return $this-> redirectToClient($client);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( AutorizeRequest $request,int $id)
    {
        $info=$request->info;
        $client=Client::find($id);
        $arrp=[];
        $arra=[];
        $documenttypes=$this->documenttypes->selectRaw("(SELECT
                                                        COUNT(id)
                                                        FROM
                                                        documents
                                                        WHERE
                                                        client_id={$client?->id} and
                                                        document_type_id=`document_types`.id) amount ");
        $autorizationclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'a%')->where('client_id',$client?->id);
        $policiesclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'p%')->where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client!=null?$client->id:0)->first();
        $loan=Loan::where('client_id',$client!=null?$client->id:0)->first();
        session(["info"=> $info]);
        $arrp=$this->getArray($policiesclients);
        $arra=$this->getArray($autorizationclients);
        $data=[
            'client'=>$client,
            'loantypes'=>$this->loantypes->get(),
            'policiesCount'=>$this->policies->count(),
            'autorizationsCount'=>$this->autorizations->count(),
            'documenttypes'=> $documenttypes->get(),
            'policies'=>$this->policies->whereNotIn ('id',$arrp)->get(),
            'autorizations'=>$this->autorizations->whereNotIn ('id',$arra)->get(),
            'policyclients'=>$policiesclients->get(),
            'autorizationsclients'=>$autorizationclients->get(),
            'contactInfos'=>$contactInfos->get(),
            'occupationalposition'=>$this->occupationalposition->get(),
            'EmploymentInformation'=>$EmploymentInformation,
            'loan'=>$loan,
            'QualityHolder'=>$this-> QualityHolder->get(),
            'ArlAffiliates'=>$this-> ArlAffiliates->get(),
            'EpsAffiliates'=>$this-> EpsAffiliates->get(),
            'cities'=>$this->cities->get(),
            'info'=>$info,
            'CompanyPaymentDates'=>$this-> CompanyPaymentDates->get(),
            'CustomerPaymentDates'=>$this-> CustomerPaymentDates->get(),
            'PaymentFrecuencies'=>$this-> PaymentFrecuencies->get(),
            'ContractTypes'=>$this-> ContractTypes->get(),
            'maritalstatus'=>$this-> maritalstatus->get(),
            'phonetypes'=>$this-> phonetypes->get(),
            'studylevels'=>$this-> studylevels->get(),
            'Warranties'=>$this->Warranties->get(),
            'States'=>$this->States->get(),
        ];
        return view('Client.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,int $id)
    {
        if(!Auth::check())
        {
            return back()->withErrors('No esta permitido actualizar el registro.
                                       Comúnicate con el administrador del
                                       sistema para mas información');
        }
        $value_title=$request->consecutive!=''? $request->letter.'-'.$request->consecutive:'';
        $arrclient=[
            'identification'=>$request->identification,
            'name_last_name'=>$request->name_last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'reference'=>$request->reference,
            'value_Title'=>$value_title,
             'city_id'=>$request->city_id,
            'date_birth'=>$request->birth_date,
            'expedition_date'=>$request->expedition_date,
            'neighborhood'=>$request->neighborhood,
            'vehicle'=>$request->vehicle==null?0:(bool)$request->vehicle ,
            'estate'=>$request->estate==null?0:(bool)$request->estate,
            'seizure'=>$request->seizure==null?0:(bool)$request->seizure,
            'quality_holder_id'=>$request->quality_holder,
            'marital_status_id'=>$request->marital_status,
            'level_study_id'=>$request->study_level
        ];
        $client = Client::find($id);
        $client->update($arrclient);
     //   session(['client' => $client]);
        session(["info"=>"0"]);
        return redirect()->to(url('/clients'))->with(['message'=>'Se ha actualizado la información del cliente']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->to(url('/clients'))->with(['message'=>'Se ha eliminado el cliente']);
        //
    }
    public function downloadExcel($id)
    {
        return Excel::download(new ClientExport($this->clients), "Masterclientes.xlsx");
    }
}
