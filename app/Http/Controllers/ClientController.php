<?php

namespace App\Http\Controllers;
use App\Exports\ClientExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\AutorizeRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
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
use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{
    protected $QualityHolder;
    protected $ArlAffiliates;
    protected $EpsAffiliates;
    protected $CompanyPaymentDates;
    protected $CustomerPaymentDates;
    protected $PaymentFrecuencies;
    protected $ContractTypes;
    protected $studylevels;
    protected $maritalstatus;
    protected $phonetypes;
    protected $clients;
    protected $Warranties;
    protected $States;
    protected $cities;
    protected $policies;
    protected $autorizations;
    protected $documenttypes;
    function __construct()
    {
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
        $this->States=State::orderby('name','asc');
        $this->clients=Client::select('clients.id',
                                   'clients.reference',
                                   'q.name as quality_holder',
                                   'clients.value_Title',
                                   'name_last_name',
                                   'clients.date_birth',
                                   'clients.expedition_date',
                                   'clients.address',
                                   'clients.email',
                                   'clients.neighborhood',
                                   'ms.name as marital_status',
                                   'einf.nit_company_work as nit',
                                   'einf.Company_works' ,
                                   'einf.main_address' ,
                                   'einf.company_on_mission',
                                   'einf.nit as nit_company_mision' ,
                                   'einf.branch_address',
                                   'einf.entry_date' ,
                                   'einf.average_monthly_salary',
                                   'einf.current_position',
                                   'fp.name as payment_frequency',
                                   'cpd.name as company_payment_date',
                                   'cuspd.name as customer_payment',
                                   'ctrtype.name as contract_type',
                                   'eps.name as eps_affiliate',
                                   'arl.name as arl_affiliate',
                                   'ls.name as level_study',
                                   'clients.vehicle',
                                   'clients.estate',
                                   'loans.ammount',
                                   'loans.term',
                                   'w.name as warranty',
                                   'clients.created_at')
                                ->selectRaw("concat(city.name ,' | ', st.name)as city")
                                ->selectRaw("concat('CC',' ', clients.identification) as identification")
                                ->selectRaw("CASE WHEN clients.seizure =1 THEN concat('SI',' | ',clients.company_seizure) ELSE 'NO' END as seizure")
                                ->selectRaw("TIMESTAMPDIFF(YEAR, clients.date_birth, CURDATE()) AS age")
                                ->selectRaw("(SELECT
                                              GROUP_CONCAT(CONCAT (pt.name,': ', ci.phone_number) separator ' ')
                                              FROM
                                              contact_informations ci	JOIN `phone_types` pt ON pt.id=ci.phone_type_id
                                              where ci.client_id=clients.id)as contact_informations")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P1')as P1")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P2')as P2")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P3')as P3")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P4')as P4")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P5')as P5")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P6')as P6")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P7')as P7")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P8')as P8")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P9')as P9")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P10')as P10")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P11')as P11")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P12')as P12")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P13')as P13")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P14')as P14")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P15')as P15")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='P16')as P16")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A1')as A1")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A2')as A2")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A3')as A3")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A4')as A4")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A5')as A5")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A6')as A6")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A7')as A7")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A8')as A8")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A9')as A9")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A10')as A10")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A11')as A11")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A12')as A12")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A13')as A13")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A14')as A14")
                                ->selectRaw("(SELECT state_policy_id FROM `client_policies` AS cp JOIN
                                             `authorization_policies` ap ON ap.id=cp.policy_id WHERE
                                             cp.client_id=clients.id AND ap.title='A15')as A15")
                                ->leftjoin("quality_holders as q","q.id","=","quality_holder_id")
                                ->join('cities as city','city.id','=','city_id' )
                                ->join('states as st','st.id','=','city.state_id'  )
                                ->join("marital_status as ms","ms.id","=","marital_status_id")
                                ->join("level_studies as ls","ls.id","=","clients.level_study_id")
                                ->leftjoin("employment_informations as einf","clients.id","=","einf.client_id")
                                ->leftjoin("eps_affiliates as eps","eps.id","=","einf.eps_affiliate_id" )
                                ->leftjoin("arl_affiliates as arl","arl.id","=","einf.arl_affiliate_id")
                                ->leftjoin("payment_frequency as fp","fp.id","=","einf.payment_frequency_id")
                                ->leftjoin("company_payment_dates as cpd","cpd.id","=","einf.company_payment_date_id")
                                ->leftjoin("customer_payment_dates as cuspd","cuspd.id","=","einf.customer_payment_date_id")
                                ->leftjoin("contract_types as ctrtype","ctrtype.id","=","einf.contract_type_id")
                                ->leftjoin("loans","clients.id","=","loans.client_id" )
                                ->leftjoin("warranties as w","w.id","=","loans.warranty_id");
    }
    public function GetClients(Request $request)
    {
        $clients=Client::select('identification')->selectRaw("name_last_name as name")
                        ->where ('clients.name_last_name','like','%'.$request->name.'%')
                        ->orderby('name_last_name','asc')->get();
        return response()->json($clients);
    }
    public function SearchByName(Request $request)
    {
        $clients=Client::where('clients.name_last_name','like','%'.$request->name.'%')
                      ->select( "id","identification")
                      ->selectRaw("name_last_name as name")
                      ->get();
        return response()->json($clients);
    }
    public function UpdateDataProccess(Request $request ,$id){
        $accept_data_treatment=$request->accept_data_treatment==null?0:(bool)$request->accept_data_treatment;
        $client=Client::find($id);
        if($client==null)
        {
            session(["info"=>"0"]);
            return redirect()->to(url('/clients/create'))
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client ->acept_data_processing_policies=$accept_data_treatment;
        $client ->update();
        session(["info"=>"6"]);
        session(['client' => $client]);
        return back() ->with(['message'=>$client ->acept_data_processing_policies?'Has aceptado las politicas de datos. Continua con las politicas ':'No has aceptado las politicas de datos']);
    }
    public function UpdateLawInformation(Request $request ,$id)
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
        session(["info"=>"4"]);
        session(['client' => $client]);
        return back() ->with(['message'=>'Se ha actualizado la información legal. Continue con la información del crédito.']);
       // return redirect()->to(url('/clients/create'))->withInput(["client_id"=>$client->id]);
    }
    public function UpdatePatrimonialInformation(Request $request ,$id)
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
        session(["info"=>"3"]);
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
        $data=['clients'=>$this-> clients->get()];
        return view('Client.index',$data);
        //
    }
    public function getArray( $policiesclients):array
    {
        $arr=[];
        foreach($policiesclients as $pc)
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
        $info=session()->has("info")?session('info'):'0';
        $arrp=$this->getArray($policiesclients->get());
        $arra=$this->getArray($autorizationclients->get());
        $data=[
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
        $arrclient=[
            'identification'=>$request->identification,
            'name_last_name'=>$request->name_last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'reference'=>$request->reference,
            'value_Title'=>$request->value_Title,
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
        session(["info"=>"1"]);
        return redirect()->to(url('/clients/create'))->with(['message'=>'Se ha creado un cliente. Ahora  debes ingresar la información de contacto']);
        //
    }
    public function redirectToClient($client)
    {
        session(['client' => $client]);
        $documenttypes=$this->documenttypes->selectRaw("(SELECT
                                                        COUNT(id)
                                                        FROM
                                                        documents
                                                        WHERE
                                                        client_id={$client?->id} and
                                                        document_type_id=`document_types`.id) amount ");
        $policies=AuthorizationPolicy::where('title', 'like', 'p%')->count();
        $autorizations=AuthorizationPolicy::where('title', 'like', 'a%')->count();
        $documents=Document::where('client_id',$client->id);
        $policiesclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'p%')->where('client_id',$client?->id);
        $autorizationclients=ClientPolicy::join('authorization_policies as p', 'client_policies.policy_id', '=', 'p.id')->where('p.title', 'like', 'a%')->where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client?->id)->first();
        $loan=Loan::where('client_id',$client?->id)->first();
        if($contactInfos->count()==0)
        {
            session(["info"=>"1"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client?->id]);
        }
        if($EmploymentInformation==null)
        {
            session(["info"=>"2"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($loan==null&& $client->quality_holder_id==1)
        {
            session(["info"=>"5"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($policiesclients->count()<$policies)
        {
            session(["info"=>"7"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($autorizationclients->count()<$autorizations)
        {
            session(["info"=>"8"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($documents->count()==0){
            session(["info"=>"9"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        $data =
        [
            'documenttypes'=> $documenttypes->get(),
            'policiesclients'=> $policiesclients->get(),
            'autorizationclients'=> $autorizationclients->get(),
            'client'=> $client
        ];
        session(['client' => $client]);
        return view('Client.show',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(request()-> has('identification'))
        {
            $client=Client::where('identification','=',request()->identification)->first();
            if($client==null)
            {
                session(["info"=>"0"]);
                return redirect()->to(url('/clients/create'))->withErrors('No se ha encontrado un cliente
                                                                        con la identificación ingresada');
            }
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
        $info=session()->has("info")?session('info'):'0';
        $arrp=$this->getArray($policiesclients->get());
        $arra=$this->getArray($autorizationclients->get());
        $data=[
            'client'=>$client,
            'documenttypes'=> $documenttypes->get(),
            'policies'=>$this->policies->whereNotIn ('id',$arrp)->get(),
            'autorizations'=>$this->autorizations->whereNotIn ('id',$arra)->get(),
            'policyclients'=>$policiesclients->get(),
            'autorizationsclients'=>$autorizationclients->get(),
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
        ];
        return view('Client.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        if(!Auth::check())
        {
            return back()->withErrors('No esta permitido actualizar el registro.
                                       Comúnicate con el administrador del
                                       sistema para mas información');
        }
        $arrclient=[
            'identification'=>$request->identification,
            'name_last_name'=>$request->name_last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'reference'=>$request->reference,
            'value_Title'=>$request->value_Title,
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
        session(['client' => $client]);
        session(["info"=>"0"]);
        return back()->with(['message'=>'Se ha actualizado la información del cliente']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->to(url('/clients'))->with(['message'=>'Se ha eliminado el cliente']);
        //
    }
    public function downloadExcel($id)
    {
        return Excel::download(new ClientExport($this->clients->get()), "Masterclientes.xlsx");
    }
}
