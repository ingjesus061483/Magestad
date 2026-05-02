@extends('Shared/layout')
@section('title',' Crear tarea')
@section('content')
<div class="card mb-4" style=" margin:0 auto">
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
                     <label for="date" class="col-form-label" style="font-size:14px">Cliente</label>
                    <input type="text"name="client" class="form-control" id="date" style="font-size:12px" value="{{old('client')}}">

                </div>
            </div>
             <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="homework_type_id" class="col-form-label" style="font-size:14px">Tipo de Tarea</label>
                   <select class="form-select" name="homework_type_id" style="font-size:12px" id="homework_type_id">
                        @foreach ($homework_types as $type)
                            <option value="{{$type->id}} {{$type->id==old('homework_type_id')?'selected':''}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="col-sm-6">
                    <label for="remark" class="col-form-label" style="font-size:14px">Tarea</label>
                    <textarea class="form-control" name="remark" id="remark" rows="3" class="form-control" style="font-size:12px" >
                        {{old('remark')}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label class="form-label" for="">Status</label>
                    <select class="form-select" name="state_homework" id="">
                        @foreach ($state_homework as $item)
                        <option value="{{$item->id}}">{{explode(' ', explode('|', $item->name)[1])[2]}}</option>
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
