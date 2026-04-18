<?php

namespace App\Http\Controllers;

use App\Http\Requests\Arl\StoreRequest;
use App\Http\Requests\Arl\UpdateRequest;
use App\Http\Requests\AutorizeRequest;
use Illuminate\Http\Request;
use App\Models\ArlAffiliate;
class ArlController extends Controller
{
    public function show($id)
    {
        return response()->json(ArlAffiliate::find($id));
        //
    }
    public function index(AutorizeRequest $request)
    {
        $data=[
            'arls'=>ArlAffiliate::orderby('name','asc')->get()
        ];
        return view('Arl.index',$data);
        //
    }
    public function store(StoreRequest $request)
    {
        try{
            $ArlAffiliate=new ArlAffiliate();
            $ArlAffiliate->name=$request->name;
            $ArlAffiliate->description=$request->description;
            $ArlAffiliate->save();
            return back()->with(['message'=>'ARL afiliada creada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try{
        $ArlAffiliate=ArlAffiliate::find($id);
        $ArlAffiliate->delete();
        return back()->with(['message'=>'ARL afiliada eliminada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
    }
    public function update(UpdateRequest $request ,$id)
    {
        try{
        $ArlAffiliate=ArlAffiliate::find($id);
        $arrArl=[
            'name'=>$request->name,
            'description'=>$request->description
        ];
        $ArlAffiliate->update($arrArl);
        return back()->with(['message'=>'ARL afiliada actualizada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
    //
    }
}
