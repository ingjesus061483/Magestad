<div class="card mb-4" style="width: 100%; display:none" id="filterForm">
    <div class="card-header">
        <i class="fas fa-filter me-1"></i>
        Filtrar por:
    </div>
    <div class="card-body">
        <form method="get" id="frmfilter" action="{{$action}}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Fecha inicio</label>
                        <input type="date" class="form-control" name="firstdate" style="font-size:12px;" value="{{$firstdate }}" id="dateStart">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Fecha final</label>
                        <input type="date" class="form-control" name="enddate" style="font-size:12px; " value="{{$enddate }}" id="dateEnd">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        @include('Shared.searchClient',['client_id' => $client_id ?? null,
                                                        'client_name' => $client_name ?? null,
                                                        'client' => null])
                    </div>
                </div>
                @if(isset($newness) && $newness)
                <div class="col-md-6">
                    <div class="mb-3">
                        @include('Shared.newnesstype', ['newness_type' => null,
                                                        'newness_type_name'=>$newness_type??null,
                                                        'newness_type_id'=>$newness_type_id?? null,
                                                       ])
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                          <label for=""style="font-size:14px" >Filas por paginas</label>
                        <input type="number" class="form-control" value="{{$rows_per_page}}" name="rows_per_page" id="rows_per_page">
                    </div>
                </div>
            </div>
            <div class="justify-content-end d-flex">
                    <button title="Ocultar filtro" type="button" class="btn btn-secondary me-2" id="btnCloseFilter">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                    <button title="Quitar filtros" onclick="dropFilters()" type="button" class="btn btn-danger me-2">
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                    </button>
                    <button title="Buscar" type="submit" class="btn btn-success">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
        </form>
    </div>
</div>
