<div class="tableFixHead card" style="margin:0 auto">
<table  class="table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">FECHA</th>
                    <th style="text-align: center" >CLIENTE	</th>
                    <th style="text-align: center">TAREA</th>
                    <th style="text-align: center">TIPO DE TAREA</th>
                    <th style="text-align: center">STATUS</th>


                </tr>
            </thead>
            <tbody style ="font-size: 12px" >
            @foreach ($homeworks as $item)
            <tr>
                <td>
                     <button id="remark" onclick="remark({{$item->id}})" class="btn btn-info" title="Comentarios">
                        <i class="fa-regular fa-comment-dots"></i>
                    </button>
                </td>
                <td style="text-align: center;">
                    <a title="Editar Tarea" href="{{url('/homework/'.$item->id.'/edit')}}" class="btn btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>
                <td>
                    @include('Shared.formDelete',['action'=>url('/homework/'.$item->id)])
                </td>
                <td style="text-align: justify;"> {{$item->user->name}}</td>
                <td style="text-align: justify;">{{date("d/m/Y", strtotime($item->date))}}</td>
                <td style="text-align: justify;">{{$item->client->reference }}</td>
                <td style="text-align: justify;">{{$item->task}}</td>
                <td style="text-align: justify;">{{$item->homework_type->name}}</td>
                <td  style="text-align: justify;align-content: justify;">
                    <div class="form-check form-switch">
                        <input class="form-check-input" {{$item->state_homework->id==2?'checked':''}} onchange="cambiarEstadoHomework({{$item->id}},this)" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">
                            {{ $item->state_homework->name}}
                        </label>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding: 5px">
        {{ $homeworks->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
