@extends('Shared/layout')
@section('title','Crear solicitud de préstamo')
@section('content')
<div class="card mb-4" style="width: 70%;margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Crear solicitud de préstamo
    </div>
    <div class="card-body">
        <form method="POST" action="{{url('/requestLoan')}}"  style="display:inline">
            @csrf
            <div class="row">
                <div class="col-sm-6" >
                    <div class="mb-3">
                        <label for="" class="form-label" style="font-size:14px">Fecha</label>
                        <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" style="font-size:12px" id="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="" class="form-label" style="font-size:14px">Nombre del cliente</label>
                        <input type="text" name="clientName" class="form-control" value="{{old('clientName')}}" style="font-size:12px" id="">
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-6" >
                    <div class="mb-3">
                        <label for="" class="form-label" style="font-size:14px">Monto solicitado</label>
                        <input type="text" name="amountRequested" class="currency form-control" value="{{number_format(old('amountRequested'))}}" style="font-size:12px" id="">
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <div class="mb-3">
                        <label for="" class="form-label" style="font-size:14px">Status</label>
                        <select name="priority" id="" class="form-select" style="font-size:12px">
                            <option value="">Seleccione una opcion</option>
                            @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ old('priority') == $priority->id ? 'selected' : '' }}
                                @switch($priority->id)
                                                            @case(1)
                                        style="color:rgba(0, 100, 0, 0.8); font-weight: bold;"
                                        @break

                                    @case (2)
                                        style="color:rgb(245, 218, 39); font-weight: bold;"
                                        @break
                                    @case(3)
                                        style="color:rgba(217, 18, 18, 0.8); font-weight: bold;"
                                        @break
                                    @endswitch>

                                {{ $priority->name}}

                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-12">
                    <div class="mb-3">
                        <label for="" class="form-label" style="font-size:14px">Comentarios</label>
                        <textarea name="comments" id="" rows="3" class="form-control" style="font-size:12px"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>

@endsection
