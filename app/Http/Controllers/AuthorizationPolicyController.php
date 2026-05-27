<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationPolicy;
use App\Http\Requests\AuthorizationPolicy\StoreRequest;
use App\Http\Requests\AuthorizationPolicy\UpdateRequest;
use App\Http\Requests\AutorizeRequest;

class AuthorizationPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        $rows_per_page=env('ROWS_PER_PAGE');
        $data=[
            "policies"=> AuthorizationPolicy::paginate($rows_per_page),
        ];
        return view("AuthorizationPolicies.index",$data);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AutorizeRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            $authorizationPolicy=new AuthorizationPolicy();
            $authorizationPolicy->title=$request->title;
            $authorizationPolicy->description=$request->description;
            $authorizationPolicy->save();
            return back()->with(['message'=>'Política de autorización creada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AutorizeRequest $request,int $id)
    {
        return response()->json(AuthorizationPolicy::find($id));
        //
    }
    public function showByTitle(AutorizeRequest $request,$id)
    {

        return response()->json(AuthorizationPolicy::where('title',$request->title)->first());
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutorizeRequest $request, AuthorizationPolicy $authorizationPolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        try{
        $authorizationPolicy=AuthorizationPolicy::find($id);
        $arrAuthorizationPolicy=[
            'title'=>$request->title,
            'description'=>$request->description
        ];
        $authorizationPolicy->update($arrAuthorizationPolicy);
        return back()->with(['message'=>'Política de autorización actualizada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
        $authorizationPolicy=AuthorizationPolicy::find($id);
        $authorizationPolicy->delete();
        return back()->with(['message'=>'Política de autorización eliminada correctamente']);
        }catch(\Exception $e){
            return back()->with(['error'=>$e->getMessage()]);
        }
        //
    }
}
