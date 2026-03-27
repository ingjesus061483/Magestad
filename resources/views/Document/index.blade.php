@extends('Shared/layout')
@section('img',url('img/CerikSoluciones.png'))
@section('title','Listado de documentos')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Listado de documentos/<strong>{{ $document_type->name}}</strong>
    </div>
    <div class="card-body">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($documents as $item)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{url('/img')}}/{{$item->path}}" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$item->name}}</h5>
                                <!-- Product price-->
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a title="Descargar documento" class="btn btn-outline-dark mt-auto" href="{{ url('documents/download/'.$item->id) }}">
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <form action="{{ url('documents/'.$item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" title="Eliminar documento" class="btn btn-danger" onclick="validar(this,'Eliminar documento?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="padding-top:5px">
            <a href="{{url('/clients')}}/{{$client_id}}" title="Regresar" class="btn btn-primary" >
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
        </div>
    </div>
</div>


    @endsection
