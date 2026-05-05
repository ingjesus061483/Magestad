@extends('Shared/layout')
@section('title','Novedades')
@section('content')
<div style="padding-bottom: 5px">
    <a  title="Crear Novedad" href="{{url('/Newness/create')}}" class="btn btn-primary" >
        <i class="fa-solid fa-plus"></i>
    </a>
    <button title="Filtrar novedad" class="btnfilter btn btn-secondary" data-title="Filtrar Novedades" data-url="{{url('/Newness')}}">
         <i class="fa-solid fa-filter"></i>
    </button>
</div>
<div id="accordion">
    @foreach($state_newnesses as $item)
    <h3>
        <a
        @switch($item->id)
        @case(1)
            style="background-color:rgba(217, 18, 18, 0.8);color:black;font-weight:bold; border-radius: 10px;"
            @break
        @case(2)
            style="background-color:rgba(0, 100, 0, 0.8);color:black;font-weight:bold; border-radius: 10px;"
            @break
    @endswitch>
        &nbsp;&nbsp;
    </a>
      <strong >&nbsp; {{ explode('|',$item->name)[0]}} </strong>&nbsp;|&nbsp;{{ explode('|',$item->name)[1] }}, {{ number_format($item->id==1?count($pendingNewnesses):count($doneNewnesses)) }}
    </h3>
    <div>
        @switch($item->id)
            @case(1)
                @include('Shared.tableNewness',['newnesses'=>$pendingNewnesses])
                @break
            @case(2)
                @include("Shared.tableNewness",['newnesses'=>$doneNewnesses])
                @break
        @endswitch
    </div>
    @endforeach
</div>
@endsection
