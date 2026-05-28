<?php

namespace App\Http\Controllers;

use App\Exports\NewnessExport;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Newness\IndexRequest;
use App\Models\Newness;
use Illuminate\Http\Request;
use App\Http\Requests\Newness\StoreRequest;
use App\Http\Requests\Newness\UpdateRequest;
use App\Models\Client;
use App\Models\NewnessType;
use App\Models\StateNewness;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class NewnessController extends Controller
{
    protected Builder $pendingNewnesses;
    protected Builder $doneNewnesses;
    protected Builder $Newnesses;
    public function __construct() {
        $this->pendingNewnesses =Newness::where('state_newness_id',1);
        $this->doneNewnesses=Newness::where('state_newness_id',2);
        $this->Newnesses=Newness::join('state_newness as sn','sn.id','=','state_newness_id')
                                ->join('newness_types as nt','nt.id','=','newness_type_id')
                                ->join('clients as c','c.id','=','client_id')
                                ->join('users as us','us.id','=','user_id')
                                ->select(
                                        'newnesses.id',
                                        'us.name as user',
                                        'newnesses.date',
                                        'c.reference as client_reference',
                                        'nt.name as newness_type',
                                        'newnesses.remark',
                                        'sn.name as status'
                                  );
    }

    /**
     * Display a listing of the resource.
     */

    public function index (FilterRequest $request)
    {
        $rows_per_page=$request->rows_per_page!=null?$request->rows_per_page: env('ROWS_PER_PAGE');
        $pendingNewnesses=$this->filterBy($request,$this->pendingNewnesses);
        $doneNewnesses=$this->filterBy($request,$this->doneNewnesses);
        $countpendingNewness=$pendingNewnesses->count();
        $countdoneNewness=$doneNewnesses->count();
        $pendingNewnesses=$pendingNewnesses->paginate($rows_per_page);
        $doneNewnesses= $doneNewnesses->paginate($rows_per_page);
        $pendingNewnesses->setPath(url('Newness'));
        $doneNewnesses->setPath(url('Newness'));
        $data=[
            'rows_per_page'=>$rows_per_page,
            'countpendingNewness'=>$countpendingNewness,
            'countdoneNewness'=>$countdoneNewness,
            'firstdate'=>$request->firstdate ? date('Y-m-d', strtotime($request->firstdate)) : null,
            'enddate'=>$request->enddate ? date('Y-m-d', strtotime($request->enddate)) : null,
            'client_name'=>$request->client,
            'client_id'=>$request->client_id,
            'newness_type'=>$request->newness_type,
            'newness_type_id'=>$request->newness_type_id,
            'pendingNewnesses'=>$pendingNewnesses,
            'doneNewnesses'=>$doneNewnesses,
            'newnesses'=>Newness::all(),
            'clients'=>Client::all(),
            'newnesstypes'=>NewnessType::all(),
            'state_newnesses'=>StateNewness::all()
        ];
        return view('Newness.index',$data);

        //
    }
    public function changeStateNewness( Request $request, int $id)
    {
        $newness=Newness::find($id);
        $newness->update(['state_newness_id'=>$request->state_newness_id]);
        return response()->json(['message'=>'Estado de novedad actualizado correctamente']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $data=['state_newnesses'=>StateNewness::all()];
        return view('Newness.create',$data);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Newness::create([
            'user_id'=>$request->user_id,
            'date'=>$request->date,
            'client_id'=>$request->client_id,
            'newness_type_id'=>$request->newness_type_id,
            'remark'=>$request->remark,
            'state_newness_id'=>$request->state_newness
        ]);
        return redirect()->to('/Newness')->with(['message'=>'Novedad creada correctamente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Newness::find($id));    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data=[
            'newness'=>Newness::find($id),
            'clients'=>Client::all(),
            'newnesstypes'=>NewnessType::all(),
            'state_newnesses'=>StateNewness::all()
        ];
        return view('Newness.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {

        $newness=Newness::find($id);
        $arrNewness=[
            'user_id'=>$request->user_id,
            'date'=>$request->date,
            'client_id'=>$request->client_id,
            'newness_type_id'=>$request->newness_type_id,
            'remark'=>$request->remark,
        ];
        $newness->update($arrNewness);
       return redirect()->to('/Newness')->with(['message'=>'Novedad actualizada correctamente']);

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int  $id)
    {
        $newness=Newness::find($id);
        $newness->delete();
        return back()->with(['message'=>'Novedad eliminada correctamente']);
        //
    }
    public function downloadExcel(int $id,FilterRequest $request)
    {
        $builder =$this->filterBy($request,$this->Newnesses);
        return Excel::download(new NewnessExport($builder),'Novedades.xls' );

    }
}
