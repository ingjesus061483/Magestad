@extends('Shared/layout')
@section('title','Listado usuarios')
@section('content')

<div class="card mb-4" style="width: 70% ;margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Listado de usuarios
    </div>
    <div class="card-body">
        <div style="padding: 5px">
            <a title="Crear usuarios" class="btn btn-primary"id="btnUser" >
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <table  class="table table-hover table-bordered" style="width:100%">
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>TELEFONO</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>
                        <button type="button" title="Actualizar" class="btn btn-warning btn-sm" onclick="editarUser({{$item->id}})"><i class="fa-solid fa-pencil"></i></button>
                    </td>
                    <td>
                         <form method="POST" action="{{url('/users')}}/{{$item->id}}"  style="display:inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
