<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Eps\StoreRequest;
use App\Http\Requests\Eps\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\EpsAffiliate;
class EpsController extends Controller
{
    public function show(int $id)
    {
        return response()->json(EpsAffiliate::find($id));
        //
    }
    public function index(AutorizeRequest $request)
    {
        $data=[
            'eps'=>EpsAffiliate::orderby('name','asc')->get()
        ];
        return view('EPS.index',$data);
        //
    }
    public function store(StoreRequest $request)
    {
        $EpsAffiliate=new EpsAffiliate();
        $EpsAffiliate->name=$request->name;
        $EpsAffiliate->description=$request->description;
        $EpsAffiliate->save();
        return back()->with(['message'=>'EPS afiliada creada correctamente']);
    }
    public function destroy(int $id)
    {
        $EpsAffiliate=EpsAffiliate::find($id);
        $EpsAffiliate->delete();
        return back()->with(['message'=>'EPS afiliada eliminada correctamente']);
    }
    public function update(UpdateRequest $request ,int $id)
    {
        $EpsAffiliate=EpsAffiliate::find($id);
        $arrEps=[
            'name'=>$request->name,
            'description'=>$request->description
        ];
        $EpsAffiliate->update($arrEps);
        return back()->with(['message'=>'EPS afiliada actualizada correctamente']);
    }
    //
}
