<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Models\EventType;
use App\Http\Requests\EventType\StoreRequest;
use App\Http\Requests\EventType\UpdateRequest;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        $rows_per_page=env('ROWS_PER_PAGE');
        $data=[
            'eventtypes'=>EventType::orderby('name','asc')->paginate($rows_per_page)

        ];
        return view('EventType.index',$data);

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
       $eventType=new EventType();
       $eventType->name=$request->name;
       $eventType->description=$request->description;
       $eventType->save();
       return back()->with(['message'=>'Tipo de evento creado correctamente']);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

       $eventtype= EventType::find($id);
       return   response()->json($eventtype);

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventType $eventType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {

       $eventType= EventType::find($id);
       $eventType->name=$request->name;
       $eventType->description=$request->description;
       $eventType->update();
       return back()->with(['message'=>'Tipo de evento actualizado correctamente']);

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $eventType=EventType::find($id);
        $eventType->delete();
        return back()->with(['message'=>'Tipo de evento eliminado correctamente']);


        //
    }
}
