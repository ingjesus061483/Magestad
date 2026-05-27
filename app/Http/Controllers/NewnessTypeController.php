<?php

namespace App\Http\Controllers;

use App\Models\NewnessType;
use App\Http\Requests\NewnessType\StoreRequest;
use App\Http\Requests\NewnessType\UpdateRequest;
use App\Http\Requests\AutorizeRequest;
use Illuminate\Http\Request;
class NewnessTypeController extends Controller
{
    protected $newnessTypes;
    public function __construct()
    {
        $this->newnessTypes=NewnessType::orderby('name','asc');
    }
    public function SearchByName(Request $request,$id)
    {
        $newnesstypes=$this->newnessTypes->where('name','like','%'.$request->name.'%')->select("id", "name")-> get();
        return response()->json($newnesstypes);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        $rows_per_page=env('ROWS_PER_PAGE');
         $data=[
            'NewnessTypes'=>$this->newnessTypes->paginate($rows_per_page),
        ];
        return view('NewnessType.index',$data);
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        NewnessType::create([
            "name"=>$request->name,
            "description"=>$request->description
        ]);
        return back()->with(['message'=>'Tipo de novedad creada correctamente']);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(NewnessType::find($id));
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        $newnessType=NewnessType::find($id);
        $newnessType->update([
            "name"=>$request->name,
            "description"=>$request->description
        ]);
        return back()->with(['message'=>'Tipo de novedad actualizada correctamente']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $newnessType=NewnessType::find($id);
        $newnessType->delete();
        return back()->with(['message'=>'Tipo de novedad eliminada correctamente']);
        //
    }
}
