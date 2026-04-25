@extends('Shared/layout')
@section('title','ARLs')
@section('module','Configuracion')
@section('content')

<div class="card mb-4" style="margin:0 auto">
    <div class="card-header" >
        <i class="fas fa-table me-1"></i>
        ARLs
    </div>
    <div class="card-body">
        <div style="padding: 5px">
            <a  title="Crear Arl" class="btnArl btn btn-primary" ><i class="fa-solid fa-plus"></i></a>
        </div>
        <table  class="table table-hover table-bordered" style="width:100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align:center">NOMBRE</th>
                    <th style="text-align:center">DESCRIPCION</th>
                </tr>
            </thead>
            <tbody style ="font-size: 12px" >
                @foreach ($arls as $item)
                <tr>
                    <td style="text-align: center" >
                        <a title="Editar" onclick="editarArl({{$item->id}})" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <form method="POST" action="{{url('/arls')}}/{{$item->id}}"  style="display:inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    <td>{{$item->name}}    </td>
                    <td>{{$item->description}}  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
