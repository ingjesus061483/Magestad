<div class="row">
@foreach($eventsByDate as $item)
@php
    $date1 = date_create($item->date);
    $date2 = date_create();
    $interval = date_diff($date1, $date2);
    $style = $interval->days === 0 ? 'background-color:blue;color:white' : '';
@endphp
<div class="col-6">
    <div class="card" style="margin-top:5px ">
        <div class="card-header" style="{{$style}}"  >
            {{date('M: d',strtotime( $item->date))}}
        </div>
        <div class="card-body">
            @foreach ($item->eventsBytype as $item2 )
            <a data-date="{{date('Y-m-d',strtotime($item->date))}}" data-event_type="{{$item2->event_type_id}}" class="btn btn-primary" onclick=" showEvents(this)" href="#" style ="font-size: 10px;margin-top:5px;" >{{$item2->event_type}}</a>
            @endforeach
        </div>
    </div>
</div>
@endforeach
</div>
