<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Http\Requests\DocumentType\StoreRequest;
use App\Http\Requests\DocumentType\UpdateRequest;
use App\Http\Requests\AutorizeRequest;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        $data=[
            "documentTypes"=> DocumentType::all(),
             ];
            return view("DocumentType.index",$data);
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
        DocumentType::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return back()->with(['message'=>'Tipo de documento creado correctamente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(DocumentType::find($id));

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentType $documentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,int $id)
    {
        $documentType=DocumentType::find($id);
        $arrDocumentType=[
            'name'=>$request->name,
            'description'=>$request->description
        ];
        $documentType->update($arrDocumentType);
        return back()->with(['message'=>'Tipo de documento actualizado correctamente']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $documentType=DocumentType::find($id);
        $documentType->delete();
        return back()->with(['message'=>'Tipo de documento eliminado correctamente']);
        //
    }
}
