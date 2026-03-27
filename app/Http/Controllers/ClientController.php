<?php

namespace App\Http\Controllers;

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
        $this->policies=AuthorizationPolicy::where('title','like','p%')-> select('*');
        $this->autorizations=AuthorizationPolicy::where('title','like','A%')-> select('*');
        $this-> QualityHolder=QualityHolder::orderby('name','asc');
        $this-> ArlAffiliates=ArlAffiliate::orderby('name','asc');
        $this->EpsAffiliates=EpsAffiliate::orderby('name','asc');
        $this->CompanyPaymentDates=CompanyPaymentDate::select('*');
        $this->CustomerPaymentDates=CustomerPaymentDate::select('*');
        $this->PaymentFrecuencies=PaymentFrecuency::select('*');
        $this->ContractTypes=ContractType ::orderby('name','asc');
        $this->studylevels=LevelStudy::select('*');
        $this->maritalstatus =MaritalStatus::orderby('name','asc');
        $this->phonetypes=PhoneType::orderby('name','asc');
        $this->Warranties=Warranty::orderby('name','asc');
        $this->States =State::orderby('name','asc');
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
                                ->selectRaw("concat('CC',' ', clients.identification) as identification")
                                ->selectRaw("CASE WHEN clients.seizure =1 THEN concat('SI',' | ',clients.company_seizure) ELSE 'NO' END as seizure")
                                ->selectRaw("TIMESTAMPDIFF(YEAR, clients.date_birth, CURDATE()) AS age")
                                ->selectRaw("(SELECT
                                              GROUP_CONCAT(CONCAT (pt.name,': ', ci.phone_number) separator ' ')
                                              FROM
                                              contact_informations ci	JOIN `phone_types` pt ON pt.id=ci.phone_type_id
                                              where ci.client_id=clients.id)as contact_informations")
                                ->leftjoin("quality_holders as q","q.id","=","quality_holder_id")
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
            return redirect()->to(url('/clients/create'))
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client ->acept_data_processing_policies=$accept_data_treatment;
        $client ->update();
        session(["info"=>"PersonData"]);
        session(['client' => $client]);
        return back() ->with(['message'=>$client ->acept_data_processing_policies?'Has aceptado las politicas de datos ':'No has aceptado las politicas de datos']);
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
            return redirect()->to(url('/clients/create'))
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client->seizure=$seizure;
        $client->company_seizure=$request->company_seizure;
        $client->update();
        session(["info"=>"law"]);
        session(['client' => $client]);
        return back() ->with(['message'=>'Se ha actualizado la información legal']);
       // return redirect()->to(url('/clients/create'))->withInput(["client_id"=>$client->id]);
    }
    public function UpdatePatrimonialInformation(Request $request ,$id)
    {
        $client=Client::find($id);
        if($client==null)
        {
            return redirect()->to(url('/clients/create'))
                             ->withInput(["client_id"=>$id])
                             ->withErrors('No se ha encontrado el cliente');
        }
        $client->vehicle=$request->vehicle==null?0:(bool)$request->vehicle;
        $client->estate=$request->estate==null?0:(bool)$request->estate;
        $client->update();
        session(["info"=>"patrimonial"]);
        session(['client' => $client]);
      //  return redirect()->to(url('/clients/create'))->withInput(["client_id"=>$client->id]);
        return back() ->with(['message'=>'Se ha actualizado la información patrimonial']);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arrp=[];
        $arra=[];
        $client=session()->has('client')?session('client'):null;
        $policiesclients=ClientPolicy::where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client?->id)->first();
        $loan=Loan::where('client_id',$client?->id)->first();
        $info=session()->has("info")?session('info'):'client';
        foreach($policiesclients->get() as $pc)
        {
            if($pc->policy->where('title','like','p%')->first()!=null)
            {
                $arrp[]=$pc->policy_id;
            }
            else if($pc->policy->where('title','like','a%')->first()!=null)
            {
                $arra[]=$pc->policy_id;
            }

        }
        $data=[
            'policies'=>$this->policies->whereNotIn ('id',$arrp)->get(),
            'autorizations'=>$this->autorizations->whereNotIn ('id',$arrp)->get(),
            'policyclients'=>$policiesclients->get(),
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
            'vehicle'=>$request->vehicle==null?0:(bool)$request->vehicle ,
            'estate'=>$request->estate==null?0:(bool)$request->estate,
            'seizure'=>$request->seizure==null?0:(bool)$request->seizure,
            'quality_holder_id'=>$request->quality_holder,
            'marital_status_id'=>$request->marital_status,
            'level_study_id'=>$request->study_level
        ];
        $client = Client::create($arrclient);
        session(['client' => $client]);
        session(["info"=>"client"]);
        return redirect()->to(url('/clients/create'))->with(['message'=>'Se ha creado un cliente']);

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
        $policies=AuthorizationPolicy::count();
        $policiesclients=ClientPolicy::where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client?->id)->first();
        $loan=Loan::where('client_id',$client?->id)->first();
        if($contactInfos->count()==0)
        {
            session(["info"=>"contact"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client?->id]);
        }
        if($EmploymentInformation==null)
        {
            session(["info"=>"employment"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($loan==null)
        {
            session(["info"=>"loan"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        if($policiesclients->count()<$policies)
        {
            session(["info"=>"AuthorizeProtocol"]);
            return redirect()->to(url('/clients/create'))->withInput(['client_id'=>$client->id]);
        }
        $data =
        [
            'documenttypes'=> $documenttypes->get(),
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
        $policiesclients=ClientPolicy::where('client_id',$client?->id);
        $contactInfos=ContactInformation::where ('client_id',$client?->id);
        $EmploymentInformation=EmploymentInformation::where ('client_id',$client!=null?$client->id:0)->first();
        $loan=Loan::where('client_id',$client!=null?$client->id:0)->first();
        $info=session()->has("info")?session('info'):'client';
        foreach($policiesclients->get() as $pc)
        {
            $arrp[]=$pc->policy_id;
        }
        $data=[
            'client'=>$client,
             'policies'=>$this->policies->whereNotIn ('id',$arrp)->get(),
            'autorizations'=>$this->autorizations->whereNotIn ('id',$arrp)->get(),

            'policyclients'=>$policiesclients->get(),
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
            return back()->withErrors('No puedes actualizar el registro sino te has logueado. Comúnicate con el administrador del sistema para mas información' );
        }
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
        session(["info"=>"client"]);
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
}
