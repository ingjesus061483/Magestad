
<div id="accordion">
    @foreach($event_types as $item)
    @php
        $events=$item->events()->where('date',request()->date)->where('event_type_id',$item->id);
    @endphp
    <h3>
       &nbsp;{{ $item->name }},
        {{ number_format($events->count()) }}
    </h3>
    <div>
        @include('Shared.Events',['events'=>$events->get()])


    </div>
    @endforeach
</div>
