@extends('Shared/layout')
@section('title','Eventos')
@section('content')
<div style="padding-bottom:5px ">
    <a  title="Crear evento" href="{{url('/events/create')}}" class="btn btn-primary" >
        <i class="fa-solid fa-plus"></i>
    </a>
    <button title="filtrar por..." class="filter btn btn-secondary" >
        <i class="filter fa-solid fa-filter"></i>
    </button>
</div>
<!--<div class="card" style="padding: 5px">
    <div class="card-body" style="margin:0 auto">
     <div id="datepicker"></div>
    </div>
</div>-->
<div class="card mb-4" style="width: 100%; display:none" id="filterForm">
    <div class="card-header">
        <i class="fas fa-filter me-1"></i>
        Filtrar por:
    </div>
    <div class="card-body">
        <form method="get" id="frmfilter" action="{{url('events')}}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Fecha inicio</label>
                        <input type="date" class="form-control" name="firstdate" style="font-size:12px;color:black" value="{{$firstdate }}" id="dateStart">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Fecha final</label>
                        <input type="date" class="form-control" name="enddate" style="font-size:12px; " value="{{$enddate }}" id="dateEnd">
                    </div>
                </div>
            </div>
            <div class="justify-content-end d-flex">
                    <button title="Ocultar filtro" type="button" class="btn btn-secondary me-2" id="btnCloseFilter">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                    <button title="Quitar filtros" onclick="dropFilters(false)" type="button" class="btn btn-danger me-2">
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                    </button>
                    <button title="Buscar" type="submit" class="btn btn-success">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="padding: 5px">
    <div class="card-body" style="margin:0 auto; height:200px; overflow: scroll; ">
        @include('Shared.Events',['eventsByDate'=>$eventsByDate])
    </div>
</div>
<div style="padding-top :5px">
    <a title="Regresar" href="{{url('/')}}?submodule=subAgenda" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>
@endsection
