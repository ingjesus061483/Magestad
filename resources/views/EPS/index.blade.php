@extends('Shared/layout')
@section('title','EPS')
@section('content')
    <div class="tableFixHead card">
        <table  class=" table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align:center">NOMBRE</th>
                    <th style="text-align:center">DESCRIPCION</th>
                </tr>
            </thead>
            <tbody style ="font-size: 12px">
                @foreach ($eps as $item)
                <tr>
                    <td style="text-align: center;">
                        <a title="Editar" onclick="editarEps({{$item->id}})" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <form method="POST" action="{{url('/eps')}}/{{$item->id}}"  style="display:inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td >
                    <td>{{$item->name}}    </td>
                    <td>{{$item->description}}  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding: 5px">
        {{$eps->links('pagination::bootstrap-5')}}

</div>
@endsection
