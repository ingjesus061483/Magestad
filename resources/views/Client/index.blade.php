@extends('Shared/layout')
@section('title','Clientes')
@section('content')
<style>
 /*.tableFixHead          { overflow: auto; height: 250px; }
.tableFixHead  thead th { position: sticky; top: 0; z-index: 1; }

/* Just common table stuff. Really.
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th {background: #eee;}*/
</style>
<div  style="padding: 5px">
    <a href="{{url('/clients/create')}}" title="Crear cliente" class="btn btn-primary" >
        <i class="fa-solid fa-plus"></i>
    </a>
      <button title="filtrar por..." class="filter btn btn-secondary" >
        <i class="filter fa-solid fa-filter"></i>
    </button>
    <a title="Exportar a excel" href="{{url('clients/downloadExcel/0')}}" class="btn btn-success">
        <i class="fa-solid fa-file-excel"></i>
    </a>

</div>
<div class="card" style="width: 100%; display:none" id="filterForm">
    <div class="card-header">
        <i class="fa-solid fa-filter"></i> Filtrar por...
    </div>
    <div class="card-body">
        <form method="GET" action="{{url('/clients')}}" id="frmfilter" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        @include('Shared.searchClient',['client_id' => $client_id ?? null,
                                                                'client_name' => $client_name ?? null,
                                                                'client' => null])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Solicitud de credito</label>
                        <input type="text" class="form-control" value="{{$loan_reference ?? ''
                        }}" name="loan_reference" id="loan_reference" style="font-size:12px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Filas por paginas</label>
                        <input type="number" class="form-control" value="{{$rows_per_page}}" name="rows_per_page" id="rows_per_page" style="font-size:12px">
                    </div>
                </div>
            </div>
            <div class="justify-content-end d-flex">
                    <button title="Ocultar filtro" type="button" class="btn btn-secondary me-2" id="btnCloseFilter">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                    <button title="Quitar filtros" onclick="dropFilters(true)" type="button" class="btn btn-danger me-2">
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                    </button>
                    <button title="Buscar" type="submit" class="btn btn-success">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
        </form>
    </div>
</div>
<div style="padding-top:5px ">

@include('Shared.tableClients',['clients'=>$clients])
</div>
<div style="padding-top:5px ">
    <a title="Regresar" href="{{url('/')}}?submodule=subClient" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>
@endsection
