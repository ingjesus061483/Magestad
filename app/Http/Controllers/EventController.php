<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Event\ShowRequest;
use App\Models\Event;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Requests\FilterRequest;
use App\Models\EventType;
use Illuminate\Database\Eloquent\Builder;

class EventController extends Controller
{
    protected Builder $event_types;
    protected Builder $events;
    function __construct()
    {
        $this->events=Event::join('event_types as evt','evt.id','=','events.event_type_id')
                           ->select('events.id' , 'evt.name AS event_type', 'events.date','events.time','events.remark');

        $this->event_types = EventType::orderBy('name');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
       // print_r($this->events->get());
        $dateFirst =$request->firstdate?? date('Y-m-d', strtotime('-7 days'));
        $dateEnd =$request->enddate?? date('Y-m-d');
        $eventsByDate= $this->GetEventsbyDate($dateFirst,$dateEnd,$this->events);
      //  print_r ($eventsByDate);
       // exit;
        $data = [
            'firstdate' => $dateFirst,
            'enddate' => $dateEnd,
            'eventsByDate' =>$eventsByDate
        ];

        return view('Event.index', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(autorizeRequest $request)
    {

        $data=['event_types'=> $this->event_types->get()];
        return view('Event.create',$data);

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Event::create([
            'event_type_id'=>$request->event_type ,
            'title'=>$request->title,
            'date'=>$request->date,
            'time'=>$request->time,
            'remark'=>$request->remark
            ]);
            return redirect()->to(url('/events'))->with(['message'=>'Evento creado correctamente']);


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id,ShowRequest $request)
    {
         $events=Event::join('event_types as et','et.id','=','event_type_id')
                      -> where ('date',$request->date)
                      ->select('events.id' ,'et.name as event_type','events.date' ,'events.time'
                      ,'events.remark');

return response()->json($events->get());
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id ,AutorizeRequest $request)
    {
        $data=[
            'event_types'=> $this->event_types->get(),
            "event"=> Event::find($id),
        ];
        return view('Event.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( UpdateRequest $request,int $id)
    {
        $event=Event::find($id);
        $event->update([
           'event_type_id'=>$request->event_type,
           'title'=>$request->title,
           'date'=>$request->date ,
           'time'=>$request->time,
           'remark'=>$request->remark
        ]);
         return redirect()->to(url('/events'))->with(['message'=>'Evento actualizado correctamente']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event=Event::find($id);
        $event->delete();
        return response()->json(['message'=>'Evento eliminado correctamente']);
        //
    }
}
