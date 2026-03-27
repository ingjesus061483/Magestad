@extends('Shared/layout')
@section('title',' Crear tarea')
@section('content')
<div class="card mb-4" style="width: 100% ; margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Crear tarea
    </div>
    <div class="card-body">
        <form id="formNewness" method="POST" action="{{url('/homework')}}" >
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
                    <label for="homework_type_id" class="col-form-label" style="font-size:14px">Tipo de Tarea</label>
                   <select class="form-select" name="homework_type_id" style="font-size:12px" id="homework_type_id">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($homework_types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="col-sm-6">
                    <label for="remark" class="col-form-label" style="font-size:14px">Tarea</label>
                    <textarea class="form-control" name="remark" id="remark" rows="3" class="form-control" style="font-size:12px" ></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="state_homework_id" class="col-form-label"style="font-size:14px">Estado </label>
                    <select  onchange="cambiarColor(this)" class="form-select" name="state_homework_id" style="font-size:12px" id="state_homework_id">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($state_homeworks as $state)
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
