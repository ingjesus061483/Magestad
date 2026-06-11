<div class="tableFixHead card" style="margin:0 auto">

    <table  class=" table-hover table-bordered" style="width: 100%" >
            <thead style ="font-size: 14px" >
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">FECHA</th>
                    <th style="text-align: center" >CLIENTE	</th>
                    <th style="text-align: center">TIPO DE NOVEDAD	</th>
                    <th style="text-align: center">NOVEDAD</th>
                    <th style="text-align: center">STATUS</th>


                </tr>
            </thead>
            <tbody style ="font-size: 12px" >
            @foreach ($newnesses as $item)
            <tr>
                <td style="text-align: center;">
                    <a title="Editar" href="{{url('/Newness/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>

                <td>
                    @include('Shared.formDelete',['action'=>url('/Newness/'.$item->id)])
                </td>
                <td style="text-align: justify;"> {{$item->user->name}}</td>
                <td style="text-align: justify;">{{date("d/m/Y", strtotime($item->date))}}</td>
                <td style="text-align: justify;">{{$item->client->reference }}</td>
                <td style="text-align: justify;">{{$item->newness_type->name}}</td>
                <td style="text-align: justify;">{{$item->remark}}</td>
                <td style="text-align: justify;align-content: justify;">
                    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" {{$item->state_newness->id==2?'checked':''}}
                     onchange="cambiarEstadoNewness({{$item->id}},this)" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault">{{ $item->state_newness->name}}</label>
</div>

                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding: 5px">
        {{ $newnesses->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
