     <table  class="table table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th style="text-align: center">N°</th>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">FECHA</th>
                    <th style="text-align: center" >CLIENTE	</th>
                    <th style="text-align: center">TIPO DE NOVEDAD	</th>
                    <th style="text-align: center">NOVEDAD</th>
                    <th style="text-align: center">STATUS</th>
                     <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>

                </tr>
            </thead>
            <tbody style ="font-size: 12px" >
            @foreach ($newnesses as $item)
            <tr>
                <td style="text-align: center;">{{$item->id}}</td>
                <td style="text-align: center;"> {{$item->user->name}}</td>
                <td style="text-align: center;">{{date("d/m/Y", strtotime($item->date))}}</td>
                <td style="text-align: center;">{{$item->client->identification.' '.$item->client->name_last_name }}</td>
                <td style="text-align: center;">{{$item->newness_type->name}}</td>
                <td style="text-align: center;">{{$item->remark}}</td>
                <td style="text-align: center;">
                    <input type="checkbox" name="" id=""{{$item->state_newness->id==2?'checked':''}} onchange="cambiarEstadoNewness({{$item->id}},this)">
                </td>
                <td style="text-align: center;">
                    <a title="Editar" href="{{url('/Newness/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
