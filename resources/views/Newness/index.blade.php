@extends('Shared/layout')
@section('title','Novedades')
@section('content')
<div style="padding-bottom: 5px">
    <a  title="Crear Novedad" href="{{url('/Newness/create')}}" class="btn btn-primary" >
        <i class="fa-solid fa-plus"></i>
    </a>
     <button title="filtrar por..." class="filter btn btn-secondary" >
        <i class="filter fa-solid fa-filter"></i>
    </button>
     <button title="Exportar a excel" onclick="download('Newness')"  class="btn btn-success">
        <i class="fa-solid fa-file-excel"></i>
     </button>
</div>
@include('Shared.filter',['action'=>url('/Newness'), 'newness'=>true])
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
      <strong >&nbsp; |  </strong>&nbsp;{{ $item->name }}, {{ number_format($item->id==1?$countpendingNewness:$countdoneNewness) }}
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
