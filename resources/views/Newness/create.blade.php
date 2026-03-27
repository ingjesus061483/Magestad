@extends('Shared/layout')
@section('title',' Crear novedad')
@section('content')
<div class="card mb-4" style="width: 100% ; margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Crear Novedad
    </div>
    <div class="card-body">
        <form id="formNewness" method="POST" action="{{url('/Newness')}}" >
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="date" class="col-form-label" style="font-size:14px">Fecha</label>
                    <input type="date"name="date" class="form-control" id="date" style="font-size:12px" value="{{date('Y-m-d')}}">
                </div>
                <div class="col-sm-6">

                    @include('Shared.searchClient')

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="newness_type_id" class="col-form-label" style="font-size:14px">Tipo de Novedad</label>
                    <input type="text"  class="form-control" name="newness_type" style="font-size:12px" id="newness_type">
                    <input type="hidden"  class="form-control" name="newness_type_id" style="font-size:12px" id="newness_type_id">
                </div>
                <div class="col-sm-6">
                    <label for="remark" class="col-form-label" style="font-size:14px">Novedad</label>
                    <textarea class="form-control" name="remark" id="remark" rows="3" class="form-control" style="font-size:12px" ></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="state_newness_id" class="col-form-label"style="font-size:14px">Estado </label>
                    <select  onchange="cambiarColor(this)" class="form-select" name="state_newness_id" style="font-size:12px" id="state_newness_id">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($state_newnesses as $state)
                            <option value="{{$state->id}}"
                                @switch($state->id)
                                @case(1)
                                    style="background-color:rgba(217, 18, 18, 0.8);color:white;"
                                    @break
                                @case(2)
                                    style="background-color:rgba(0, 100, 0, 0.8);color:white;"
                                    @break
                                @endswitch>{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
