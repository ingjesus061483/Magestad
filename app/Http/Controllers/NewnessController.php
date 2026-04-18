<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Models\Newness;
use Illuminate\Http\Request;
use App\Http\Requests\Newness\StoreRequest;
use App\Http\Requests\Newness\UpdateRequest;
use App\Models\Client;
use App\Models\NewnessType;
use App\Models\StateNewness;
class NewnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(AutorizeRequest $request)
    {
        $pendingNewnesses=Newness::where('state_newness_id',1)->get();
        $doneNewnesses=Newness::where('state_newness_id',2)->get();
        $data=[
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
    public function changeStateNewness( Request $request, $id)
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
            'state_newness_id'=>1
        ]);
        return redirect()->to('/Newness')->with(['message'=>'Novedad creada correctamente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return response()->json(Newness::find($id));    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
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
    public function update(UpdateRequest $request, $id)
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
    public function destroy( $id)
    {
        $newness=Newness::find($id);
        $newness->delete();
        return back()->with(['message'=>'Novedad eliminada correctamente']);
        //
    }
}
