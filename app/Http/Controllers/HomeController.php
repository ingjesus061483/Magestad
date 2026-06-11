<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationPolicy;
use App\Models\ClientPolicy;
use App\Models\Event;
use App\Models\Homework;
use App\Models\Newness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\NoticeType;

class HomeController extends Controller
{
    public function index()
    {
        $events=Event::join('event_types', 'events.event_type_id', '=', 'event_types.id')->where('events.date', date('Y-m-d'));
        $pendingTasks  =Homework::where('state_homework_id',1);
        $pendingNewnesses =Newness::where('state_newness_id',1);
        $clients=Client::join('loans','clients.id','=','loans.client_id') ->where('loans.loan_status_id',1);
        $notice_union=$pendingTasks->selectRaw('task AS name, remark, 15 as notice_type_id')
                           ->union($pendingNewnesses->selectRaw('newness_types.name, newnesses.remark, 16 as notice_type_id')
                                                    ->join('newness_types','newness_types.id','=','newnesses.newness_type_id'))
                           ->union($events->selectRaw('event_types.name, events.remark, 14 as notice_type_id'))
                           ->union($clients->selectRaw('clients.name_last_name AS name,clients.reference AS remark, 2 as notice_type_id'));
        $notice_types= $notice_union;
        $notice_type_details= NoticeType::select('notice_types.id as notice_type_id',
                                                 'notice_types.name as notice_type',
                                                  DB::raw('COUNT(notice_union.name) as detail_notice_type'))
                                        ->leftJoinSub($notice_union, 'notice_union', function ($join)
                                                             {
                                                                $join->on('notice_types.id', '=', 'notice_union.notice_type_id');
                                                             })
                                        ->groupBy('notice_types.id', 'notice_types.name')
                                        ->orderBy('notice_types.name');
        $clients=$this-> GetClientsBuider()->where('loans.loan_status_id','=',1)->paginate(env('ROWS_PER_PAGE'));
        $events=Event::join('event_types', 'events.event_type_id', '=', 'event_types.id')->select('events.id','event_types.name as event_type','events.time','events.remark');
        $eventsByDate=$this->GetEventsbyDate(date('Y-m-d'),date('Y-m-d'),$events);

        $pendingTasks  =Homework::where('state_homework_id',1)->paginate(env('ROWS_PER_PAGE'));
        $pendingNewnesses =Newness::where('state_newness_id',1)->paginate(env('ROWS_PER_PAGE'));
        $data=[
            'events'=>$eventsByDate,
            'submodule'=> request()->submodule!=null?request()->submodule:'',
            'notice_types_details'=>$notice_type_details->get(),
            'notice_type_total'=> $notice_types->count(),
            'Tasks'=>$pendingTasks,
            'Newnesses'=>$pendingNewnesses,
            'clients'=>$clients
        ];
        $client=session()->has('client')?session('client'):null;
        if($client==null){
            return view('Home.welcome',$data);
        }
        $policy=ClientPolicy::where('client_id',$client?->id)->count();
        if($client->contact_informations->count()==0)
        {
               session(["info"=>"2"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información personal no ha sido completada");
        }
        else if($client->employment_informations->count()==0)
        {
             session(["info"=>"3"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información laboral no ha completada");
        }
        else if($client->loans->count()==0 && $client->quality_holder_id==1)
        {
            session(["info"=>"6"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información de préstamos no ha sido completada");
        }
        else if($policy<AuthorizationPolicy::count() )
        {
            session(["info"=>"7"]);
            return redirect()->to(url('/clients/create'))->
            withErrors("La información de políticas no ha sido completada");
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
        return view('Home.welcome',$data);
    }
    //
}
