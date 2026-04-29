      <table  class="table table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align: center">N°</th>
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
                <td style="text-align: center;">
                    <a title="Editar" href="{{url('/homework/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>
                <td style="text-align: center;">{{$item->id}}</td>
                <td style="text-align: center;"> {{$item->user->name}}</td>
                <td style="text-align: center;">{{date("d/m/Y", strtotime($item->date))}}</td>
                <td style="text-align: center;">{{$item->client }}</td>
                <td style="text-align: center;">{{$item->remark}}</td>
                <td style="text-align: center;">{{$item->homework_type->name}}</td>
                <td style="text-align: center;">
                    <input type="checkbox" class="form-check-input" name="" id=""{{$item->state_homework->id==2?'checked':''}}
                    onchange="cambiarEstadoHomework({{$item->id}},this)">
                    <label class="form-check-label" for="">{{explode('|',$item->state_homework->name)[1] }}</label>
                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
