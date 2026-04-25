@extends('Shared/layout')
@section('title',' Editar tarea')
@section('content')
<div class="card mb-4" style="margin:0 auto">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Editar tarea
    </div>
    <div class="card-body">
        <form id="formNewness" method="POST" action="{{url('/homework')}}/{{$homework->id}}" >
            @csrf
            @method('PATCH')
            <input type="hidden" name="state_homework_id" id="state_homework_id" value="{{$homework->state_homework_id}}">
            <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date" class="col-form-label" style="font-size:14px">Fecha</label>
                    <input type="date"name="date" class="form-control" id="date" style="font-size:12px" value="{{ date('Y-m-d', strtotime($homework->date)) }}">
                </div>
                <div class="col-md-6">
                    <label for="client_id" class="col-form-label" style="font-size:14px">Cliente</label>
                    <input type="text"name="client" class="form-control" id="client_id" style="font-size:12px" value="{{$homework->client}}">

                </div>
            </div>
            <div class="mb-3">
                <label for="remark" class="col-form-label" style="font-size:14px">Tarea</label>
                <textarea class="form-control" name="remark" id="remark" rows="3" class="form-control" style="font-size:12px" >{{$homework->remark}}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
