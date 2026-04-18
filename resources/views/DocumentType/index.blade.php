@extends('Shared/layout')
@section('title','Listado de tipo de documentos')
@section('content')

<div class="card mb-4" style="width: 70%;margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Listado de tipo de documentos
    </div>
    <div class="card-body">
        <div style="padding: 5px">
            <a  title="Crear tipo de documento" id="btnDocumenType" class="btn btn-primary" ><i class="fa-solid fa-plus"></i></a>
        </div>

        <table  class="table table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align:center">NOMBRE</th>
                    <th style="text-align:center">DESCRIPCION</th>
                </tr>
            </thead>
            <tbody style ="font-size: 12px">
                @foreach ($documentTypes as $item)
                <tr>
                    <td style="text-align: center">
                        <a title="Editar" onclick="editarDocumentType({{$item->id}})" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <form method="POST" action="{{url('/DocumentType')}}/{{$item->id}}"  style="display:inline">
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
