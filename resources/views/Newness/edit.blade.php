@extends('Shared/layout')
@section('title',' Editar novedad')
@section('content')
<div class="card mb-4" style="width: 100% ; margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Editar Novedad
    </div>
    <div class="card-body">
        <form id="formNewness" method="POST" action="{{url('/Newness')}}/{{$newness->id}}" >
            @csrf
            @method('PATCH')
            <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="state_newness_id" id="state_newness_id" value="{{$newness->state_newness_id}}">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date" class="col-form-label" style="font-size:14px">Fecha</label>
                    <input type="date"name="date" class="form-control" id="date" style="font-size:12px" value="{{ date('Y-m-d', strtotime($newness->date)) }}">
                </div>
                <div class="col-md-6">
                    <label for="client_id" class="col-form-label" style="font-size:14px">Cliente</label>
                    <input type="text"name="client" class="client form-control" id="client" value="{{$newness->client}}" style="font-size:12px">

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="newness_type_id" class="col-form-label">Tipo de Novedad</label>
                    <input type="text" onFocus="focus(this)" class="form-control" name="newness_type_id" style="font-size:12px" value="{{$newness->newness_type->id.' - '.$newness->newness_type->name}}" id="newness_type_id">
                </div>
            </div>
            <div class="mb-3">
                <label for="remark" class="col-form-label" style="font-size:14px">Novedad</label>
                <textarea class="form-control" name="remark" id="remark" rows="3" class="form-control" style="font-size:12px" >{{$newness->remark}}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
