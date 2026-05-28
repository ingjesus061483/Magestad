@extends('Shared/layout')
@section('title','Tareas')
@section('content')
<div style="padding-bottom: 5px">
    <a  title="Crear Tarea" href="{{url('/homework/create')}}" class="btn btn-primary" >
        <i class="fa-solid fa-plus"></i>
    </a>
    <button title="filtrar por..." class="filter btn btn-secondary" >
        <i class="filter fa-solid fa-filter"></i>
    </button>
     <button title="Exportar a excel" onclick="download('Homework')"  class="btn btn-success">
        <i class="fa-solid fa-file-excel"></i>
     </button>
</div>
@include('Shared.filter',['action'=>url('/homework')])
<div id="accordion">
    @foreach ($state_homeworks as $item)
    <h3>
        <a
        @switch($item->id)
        @case(1)
      style="background-color:rgba(217, 18, 18, 0.8);color:white; border-radius: 10px;"
            @break
        @case(2)

                  style="background-color:rgba(0, 100, 0, 0.8);color:white; border-radius: 10px;"
             @break
        @case(3)
        style="background-color:rgb(245, 218, 39);border-radius:10px"
        @endswitch >
        &nbsp;&nbsp;

    </a>
      <strong >&nbsp; </strong>&nbsp;|&nbsp;{{ $item->name }},
       {{ number_format($item->id==1?$countpendingTasks:$countdoneTasks) }}
    </h3>
    <div>
        @switch($item->id)
            @case(1)
            @include('Shared.tableTasks',['homeworks'=>$pendingTasks])
                @break
            @case(2)
            @include("Shared.tableTasks",['homeworks'=>$doneTasks])
                @break

        @endswitch

    </div>
    @endforeach
</div>
<div style="padding-top:5px ">
    <a href="{{url('/')}}?submodule=subDay" title="Regresar" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>
@endsection
