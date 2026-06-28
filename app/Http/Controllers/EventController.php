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
    protected $months=[
        '01'=>'Enero',
        '02'=>'Febrero',
        '03'=>'Marzo',
        '04'=>'Abril',
        '05'=>'Mayo',
        '06'=>'Junio',
        '07'=>'Julio',
        '08'=>'Agosto',
        '09'=>'Septiembre',
        '10'=>'Octubre',
        '11'=>'Noviembre',
        '12'=>'Dicienbre',
    ];
    function __construct()
    {
        $this->events=Event::join('event_types as evt','evt.id','=','events.event_type_id')
                           ->select('events.id' , 'evt.name AS event_type', 'events.date','events.time','events.remark');

        $this->event_types = EventType::orderBy('name');
    }
    function GetCalendar(string $year,string $month):array
    {
        $firstOfMonth = new \DateTimeImmutable(sprintf('%04d-%02d-01', $year, $month));
        $lastOfMonth = $firstOfMonth->modify('last day of this month');
        $week = array_fill(0, 7, null);
        $current = $firstOfMonth;
        $calendar = [['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                    'Viernes', 'Sábado'],];
        while ($current <= $lastOfMonth)
        {
            $dayIndex = (int)$current->format('w');
            $date=(object)[
                'day'=>  $current->format('d'),
                'events'=>Event::where('date',$current->format('Y-m-d'))->count()
            ];
            $week[$dayIndex] =$date;
            if ($dayIndex === 6) {
                $calendar[] = $week;
                $week = array_fill(0, 7, null);
            }
            $current = $current->modify('+1 day');
        }
        if (array_filter($week, fn ($value) => $value !== null)) {
            $calendar[] = $week;
        }
        return $calendar;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $year = $request->year??date('Y');
        $month = $request->month ??date('m');
        $calendar=$this->GetCalendar($year,$month);
        $data = [
            'month'=>$month,
            'year'=>$year,
            'months'=>$this->months,
            'calendar'=>$calendar,

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
        $event_types=EventType::all();
        $data=[
            'event_types'=> $event_types,
        ];

        return view('Event.show',$data);
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
