<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Homework;
use Illuminate\Http\Request;
use App\Http\Requests\Homework\StoreRequest;
use App\Http\Requests\Homework\UpdateRequest;
use \App\Models\StateHomework;
use App\Models\Client;
use App\Models\HomeworkType;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
class HomeworkController extends Controller
{
        protected Builder $pendingTasks;
        protected Builder $doneTasks;
        protected Builder $tasks;
    public function __construct() {
        $this->pendingTasks  =Homework::where('state_homework_id',1);
        $this->doneTasks=Homework::where('state_homework_id',2);
        $this->tasks=Homework::join('state_homework as sh','sh.id','=','state_homework_id')
                             ->join('clients as c','c.id','=','client_id')
                             ->join('homework_types as ht','ht.id','=','homework_type_id')
                             ->join('users as u','u.id','=','user_id' )
                             ->select('homework.id',
                                      'u.name as user_name',
                                      'homework.date',
                                      'c.reference as client_reference',
                                      'homework.task as title',
                                      'homework.remark',
                                      'ht.name as homework_type',
                                      'sh.name as state_homework');

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
    public function index(FilterRequest $request)
    {
        $rows_per_page=$request->rows_per_page!=null?$request->rows_per_page: env('ROWS_PER_PAGE');
        $countpendingTasks=0;
        $countdoneTasks=0;
        $pendingTasks=$this->filterBy($request,$this->pendingTasks);
        $doneTasks=$this->filterBy($request,$this->doneTasks);
        $countpendingTasks=$pendingTasks->count();
        $countdoneTasks=$doneTasks->count();
        $pendingTasks=$pendingTasks->paginate($rows_per_page);
        $doneTasks=$doneTasks->paginate($rows_per_page);
        $pendingTasks->setPath(url('homework'));
        $doneTasks->setPath(url('homework'));
        $data=[
            'rows_per_page'=>$rows_per_page,
            'firstdate'=>$request->firstdate ? date('Y-m-d', strtotime($request->firstdate)) : null,
            'enddate'=>$request->enddate ? date('Y-m-d', strtotime($request->enddate)) : null,
            'client_name'=>$request->client,
            'client_id'=>$request->client_id,
            'pendingTasks'=>$pendingTasks,
            'doneTasks'=>$doneTasks,
            'countpendingTasks'=>$countpendingTasks,
            'countdoneTasks'=>$countdoneTasks,
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
            'client_id'=>$request->client_id,
            'task'=>$request->task,
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
            'client_id'=>$request->client_id,
            'task'=>$request->task,
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
    public function downloadExcel(int $id,FilterRequest $request)
    {
        $builder =$this->filterBy($request,$this->tasks);
        return Excel::download(new TasksExport($builder),'Tareas.xls' );

    }
}
