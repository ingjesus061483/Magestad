<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\FilterRequest;
use App\Models\Client;
use App\Models\Event;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * obtiene los eventos de un conjunto de fechas determinado
     **/
    public function GetEventsbyDate(string $dateFirst,string $dateEnd,Builder $events ):array
    {
        $eventsByDate = [];
        $date = $dateEnd;
        while (strtotime($date) >= strtotime($dateFirst)) {
           // echo'<br>'. $date.'<br>';
            $eventsForDate = Event::join('event_types as evt','evt.id','=','events.event_type_id')
                                  ->where('date','=',$date)
                                  ->select('events.id' ,
                                           'events.title',
                                           'evt.name AS event_type',
                                           'evt.id AS event_type_id',
                                           'events.date',
                                           'events.time',
                                           'events.remark')
                                  ->orderBy('time')->get();
            $eventsByDate[] =(object) [
                    'date' => $date,
                    'eventsBytype' =>$this-> eventbytype($date,$eventsForDate)
            ];
            $date = date('Y-m-d', strtotime($date . ' -1 day'));
        }
        sort($eventsByDate);

        return $eventsByDate;
    }
  private  function eventbytype(string $date, Collection $eventsForDate):array{
        $eventsbytype=[];
        foreach($eventsForDate as $event)
        {
            $eventsbytype[]=(object)[
                'event_type'=>$event->event_type,
                'events'=>Event::join('event_types as evt','evt.id','=','events.event_type_id')
                                  ->where('date','=',$date)
                                  ->where('evt.id',$event->event_type_id)
                                  ->select('events.id' ,
                                           'events.title',
                                           'evt.name AS event_type',
                                           'events.date',
                                           'events.time',
                                           'events.remark')
                                  ->orderBy('time')->get()


            ];
        }
        return array_unique( $eventsbytype,SORT_REGULAR );
    }

    public function GetClientsBuider():Builder
    {
        return Client::select('clients.id',
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
                                   'op.name as occupational_position',
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
                                   'loans.reference as Loan_reference',
                                   'loans.ammount',
                                   'loans.term',
                                   'l_status.name as loan_status',
                                   'w.name as warranty',
                                   "lt.name as loan_type",
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
                                ->leftjoin('cities as city','city.id','=','city_id' )
                                ->leftjoin('states as st','st.id','=','city.state_id'  )
                                ->leftjoin("marital_status as ms","ms.id","=","marital_status_id")
                                ->leftjoin("level_studies as ls","ls.id","=","clients.level_study_id")
                                ->leftjoin("employment_informations as einf","clients.id","=","einf.client_id")
                                ->leftjoin("occupational_positions as op","op.id","=","einf.occupational_position_id")
                                ->leftjoin("eps_affiliates as eps","eps.id","=","einf.eps_affiliate_id" )
                                ->leftjoin("arl_affiliates as arl","arl.id","=","einf.arl_affiliate_id")
                                ->leftjoin("payment_frequency as fp","fp.id","=","einf.payment_frequency_id")
                                ->leftjoin("company_payment_dates as cpd","cpd.id","=","einf.company_payment_date_id")
                                ->leftjoin("customer_payment_dates as cuspd","cuspd.id","=","einf.customer_payment_date_id")
                                ->leftjoin("contract_types as ctrtype","ctrtype.id","=","einf.contract_type_id")
                                ->leftjoin("loans","clients.id","=","loans.client_id" )
                                ->leftjoin("loan_types as lt","lt.id","=","loans.loan_type_id")
                                ->leftjoin("warranties as w","w.id","=","loans.warranty_id")
                                ->leftjoin("loan_statuses as l_status","l_status.id","=","loans.loan_status_id");

    }
    /**
     * filtro de novedades, tareas y solicitudes de prestamos
     **/
    public function filterBy(FilterRequest $request,Builder $builder ): Builder
    {
        $build=$builder;
        if($request->firstdate!=null&&$request->enddate!=null)//dates
        {
            $build=$builder->wherebetween('date', [
                                                        $request->firstdate,
                                                        $request->enddate
                                                    ]);
            if($request->client_id!=null)
            {
                $build=$build->where('client_id',$request->client_id);
            }
            if($request->newness_type_id!=null)
            {
                $build=$build->where('newness_type_id',$request->newness_type_id);
            }
        }
        else if($request->client_id!=null && $request->newness_type_id!=null)
        {
            $build=$builder->where('client_id',$request->client_id)
                                                     ->where('newness_type_id',$request->newness_type_id);
        }
        else if($request->client_id!=null )
        {
            $build=$builder->where('client_id',$request->client_id);
        }
        else if($request->newness_type_id!=null)
        {
            $builder=$builder->where('newness_type_id',$request->newness_type_id);
        }
        return $build;


    }
    /*
    Sube una imagen
     */

    public function getImage(Request $request,string $nombre){
        $nombreimagen=null;
        if($request->hasFile('file'))
        {
            $imagen=$request->file('file');
            $nombreimagen=Str::slug($nombre).".".$imagen->guessExtension();
            $ruta=storage_path('app/public/img');
            if (!file_exists($ruta))
            {
                 mkdir($ruta);
            }
            if(file_exists($ruta.'\\'.$nombreimagen))
            {
                unlink($ruta.'\\'.$nombreimagen);
            }
            copy($imagen->getRealPath(),$ruta.'\\'.$nombreimagen);
        }
        return $nombreimagen;
    }


}
