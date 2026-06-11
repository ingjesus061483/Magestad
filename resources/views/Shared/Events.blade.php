<div class="row">
@foreach($eventsByDate as $item)
<div class="col-sm-6">
    <div class="card" style="margin-top:10px ">
        <div class="card-header">
            {{date('d/m/Y',strtotime( $item->date))}}
        </div>
        <div class="card-body">
            <div class="row" >
                @foreach ($item->eventsBytype as $item2 )
                <div class ='col-sm-6' style='padding:5px;'>
                    <div class='card'>
                        <div class='card-header' style='align-text:center;align-items:center;'>
                           <strong> {{$item2->event_type}}  </strong>
                        </div>
                        <div class='card-body' >
                            <div style="height: 300px;overflow:scroll; ">
                                <ol>
                                @foreach ($item2->events as $item3 )
                                    <li>{{$item3->title}} </li>
                                    <p><strong>Hora:</strong>&nbsp;{{date("h:i:s a",strtotime($item3->time))}}</p>
                                    @if($item3->remark)
                                    <div style='height:100px; overflow: scroll;'>
                                        {{$item3->remark}}
                                    </div>
                                    @endif
                                    <div style='padding:5px'>
                                        <button class='btn-sm btn-warning'onclick="editEvent({{$item3->id}})" title='Editar evento' style='margin-left:10px' >
                                            <i class='fa-solid fa-pencil'></i>
                                        </button>
                                        <button class='btn-sm btn-danger' onclick="deleteEvent({{$item3->id}})" style='margin-left:10px' title='Eliminar evento'>
                                            <i class='fa-solid fa-trash'></i>
                                        </button>
                                    </div>
                                    <hr>
                                @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endforeach
</div>
