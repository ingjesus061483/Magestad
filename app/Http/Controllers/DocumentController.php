<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\ShowRequest;
use App\Models\Document;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Models\Client;
use App\Models\DocumentType;

class DocumentController extends Controller
{
    public function Download($id)
    {
        $document=Document::find($id);
        return response()->download(public_path('img/'.$document->name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ShowRequest $request)
    {
        $document_type=DocumentType::find($request->document_type_id);
        $documents=Document::where('client_id',$request->client_id)
                           ->where('document_type_id',$request->document_type_id)
                           ->get();
        if(count($documents)==0)
        {
            return back()->withErrors("No has insertado ningun documento");
        }
        $data=[
            'client_id'=>$request->client_id,
            'documents'=>$documents,
            'document_type'=>$document_type,
        ];
        return view("Document.index",$data);
      //  $client=Client::find($request->client_id);
      //  session(['client' => $client]);
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
        $client= Client::find($request->client);
        $document_type=DocumentType::find($request->document_type);
        $document=document::where('client_id',$request->client)->where('document_type_id',$request->document_type)->orderby('id','desc')->first();
        $id=$document? $document->id +1 :1;
        $name= "$document_type->name($id)";
        $path=$this->getImage($request,"$document_type->name $client->identification $id");
        Document::create([
            'client_id'=>$request->client,
            'document_type_id'=>$request->document_type,
            'name'=>$name,
            'path'=>$path,
            'description'=>$request->description,
        ]);
       return redirect()->to(url('documents')."?client_id=$request->client&document_type_id=$request->document_type")
                        ->with(['message'=>'Documento cargado correctamente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document=Document::find($id);
        return response()->json($document);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document=Document::find($id);
        $client=$document->client;
        $document_path=public_path('img/'.$document->name);
        $document->delete();
        if (file_exists($document_path)) {
            unlink($document_path);
        }
        return redirect()->to(url("/clients")."/".$client->id)->with(['message'=>'Documento eliminado correctamente']);
        //
    }
}
