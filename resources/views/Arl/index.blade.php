@extends('Shared/layout')
@section('title','ARLs')
@section('module','Configuracion')
@section('content')
<div style="padding: 5px">
    <a  title="Crear Arl" class="btnArl btn btn-primary" ><i class="fa-solid fa-plus"></i></a>
</div>
<div class="tableFixHead card">
    <table  class="table-hover table-bordered" style="width:100%" >
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
                    @include('Shared.formDelete',['action'=>url("/arls/$item->id")])
                    <!--<form method="POST" action="{{url('/arls')}}/{{$item->id}}"  style="display:inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')"><i class="fa-solid fa-trash"></i></button>
                    </form>-->
                </td>
                <td>{{$item->name}}    </td>
                <td>{{$item->description}}  </td>
            </tr>
             @endforeach
        </tbody>
    </table>
</div>
<div style="padding: 5px">
    {{$arls->links('pagination::bootstrap-5')}}
</div>
@endsection
