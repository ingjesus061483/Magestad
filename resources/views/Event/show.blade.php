@extends('Shared/layout')
@section('title','Mostrar eventos')
@section('content')
@include('Shared.EventTypes',['event_types'=>$event_types])
<div style="padding-top :5px">
    <a title="Regresar" href="{{url('/events')}}" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>

@endsection
