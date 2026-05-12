<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Homework\IndexRequest;
use App\Models\Homework;
use Illuminate\Http\Request;
use App\Http\Requests\Homework\StoreRequest;
use App\Http\Requests\Homework\UpdateRequest;
use \App\Models\StateHomework;
use App\Models\Client;
use App\Models\HomeworkType;
class HomeworkController extends Controller
{
        protected  $pendingTasks;
        protected $doneTasks;
    public function __construct() {
        $this->pendingTasks  =Homework::where('state_homework_id',1);
        $this->doneTasks=Homework::where('state_homework_id',2);
    }
    public function changeStateHomework( Request $request,int $id)
    {
        $homework=Homework::find($id);
        $homework->update(['state_homework_id'=>$request->state_homework_id]);
        return response()->json(['message'=>'Estado de tarea actualizado correctamente']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $pendingTasks=$this->pendingTasks->where('client','like',"%$request->client%")
                                         ->orwherebetween('date', [
                                                        $request->firstdate,
                                                        $request->enddate
                                                    ])
                                        ->get();
        $doneTasks=$this->doneTasks->where('client','like',"%$request->client%")
                                   ->orwherebetween('date', [
                                                        $request->firstdate,
                                                        $request->enddate
                                                    ])
                                   ->get();
         $data=[
            'pendingTasks'=>$pendingTasks,
            'doneTasks'=>$doneTasks,
            'homeworks'=>Homework::all(),
            'state_homeworks'=>StateHomework::all(),
        ];
        return view ('Homework.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AutorizeRequest $request)
    {
        $data=[
            'homework_types'=>HomeworkType::all(),
            'state_homework'=>StateHomework::all()
        ];
        return view('Homework.create',$data);

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Homework::create([
            'user_id'=>$request->user_id,
            'date'=>$request->date,
            'client'=>$request->client,
            'remark'=>$request->remark,
            'state_homework_id'=>$request->state_homework,
            'homework_type_id'=>$request->homework_type_id
        ]);
        return redirect()->to('/homework')->with(['message'=>'Tarea creada correctamente']);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Homework::find($id));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( int $id)
    {
        $homework=Homework::find($id);
        return view('Homework.edit',['homework'=>$homework]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,int  $id)
    {
        $homework=Homework::find($id);
        $homework->update([
            'user_id'=>$request->user_id,
            'date'=>$request->date,
            'client'=>$request->client,
            'remark'=>$request->remark,
            'state_homework_id'=>$request->state_homework_id,
           // 'homework_type_id'=>$request->homework_type_id
        ]);
        return redirect()->to('/homework')->with(['message'=>'Tarea actualizada correctamente']);


        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $homework=Homework::find($id);
        $homework->delete();
        return back()->with(['message'=>'Tarea eliminada correctamente']);


        //
    }
}
