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
                        <label for=""style="font-size:14px" >Año</label>
                        <input type="number" class="form-control" name="year" style="font-size:12px;color:black" value="{{ $year }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="" style="font-size:14px"> Mes</label>
                        <select name="month" class="form-select" style="font-size:12px">
                            @foreach($months as $item=>$index)
                            <option value="{{$item}}" {{$month==$item?'selected':''}}>{{$index}}</option>
                            @endforeach
                        </select>
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


<div class="card">
    <div class="card-header"><i class="fa-regular fa-calendar-days"></i>&nbsp; {{date('F',strtotime( $year.'-'.$month.'-01'))}}&nbsp; {{$year}} </div>
    <div class="card-body">
        <div>
        <table class="table" >
            <thead>
                @foreach ($calendar[0] as $weekday)
                <th>{{$weekday}}</th>
                @endforeach
            </thead>
            <tbody>
                @for ($i = 1; $i < count($calendar); $i++)
                <tr>
                    @for ($j = 0; $j <= 6; $j++)
                    <td>
                        <a href="{{url('events')}}/0?date={{$year.'-'.$month.'-'.($calendar[$i][$j]->day ?? '')}}"  style="{{$calendar[$i][$j]?->events>0?'color:black':''}}"> {{ ($calendar[$i][$j]->day ?? '') }}</a>
                    </td>
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
        </div>
    </div>
</div>

<div style="padding-top :5px">
    <a title="Regresar" href="{{url('/')}}?submodule=subAgenda" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>
@endsection
