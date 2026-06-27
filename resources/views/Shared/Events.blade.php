<div class="row">
@foreach($events as $item)

<div class="col-sm-6">
    <div class="card" style="margin-top:5px ">
        <div class="card-header" >
            {{ $item->title}}
        </div>
        <div class="card-body">
            <strong>Hora:</strong>&nbsp;{{date('h:i A',strtotime($item->time))}}
            <div style="margin-top:10px; overflow: auto;height:300px">
            {{$item->remark}}
            </div>
            <div style='padding:5px'>
                <button class='btn-sm btn-warning'onclick='editEvent("{{$item->id}}")' title='Editar evento' style='margin-left:10px' >
                    <i class='fa-solid fa-pencil'></i>
                </button>
                <button class='btn-sm btn-danger' onclick=' deleteEvent("{{$item->id}}")' style='margin-left:10px' title='Eliminar evento'>
                    <i class='fa-solid fa-trash'></i>
                </button>
            </div>

        </div>
    </div>
</div>
@endforeach
</div>
