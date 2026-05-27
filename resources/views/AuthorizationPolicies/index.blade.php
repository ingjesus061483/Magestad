@extends('Shared/layout')
@section('title','Politicas y autorizaciones')
@section('module','Configuracion')
@section('content')


        <div style="padding: 5px">
            <a  title="Crear politica o autorizacion" class="btnPolicy btn btn-primary" ><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="card mb-3" style="padding: 5px; height:300px;overflow: auto;">
            @foreach($policies as $item)
            <div style="margin-top:10px;border-radius: 25px; border:2px solid rgba(180, 158, 169, 0.2);padding:5px; ">
            <p style="text-align: justify;padding:5px; font-size:12px;"> <strong>{{$item->title}}</strong> &nbsp;| &nbsp;
                {{$item->description}}
                <div style="padding: 5px;">
                    <a title="Editar" onclick="editarPolicy({{$item->id}})" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pencil"></i>
                    </a>&nbsp;
                    <form method="POST" action="{{url('/authorizationPolicies')}}/{{$item->id}}"  style="display:inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div style="padding: 5px">
            {{$policies->links('pagination::bootstrap-5')}}

    </div>

@endsection
