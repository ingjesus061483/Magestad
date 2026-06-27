@extends('Shared/layout')
@section('title','Crear evento')
@section('content')
<div class="card mb-4" style="padding:5px" >
    <div class="card-body">
    <form action="{{url('/events')}}" method="post" autocomplete="off">
        @csrf
        <div class="row mb-3">
            <div class="col-sm-6">
                <label for="date" class="col-form-label" style="font-size:14px">Titulo</label>
                <input type="text"name="title" class="form-control" id="title" style="font-size:12px" value="{{old('title')}}">
            </div>
            <div class="col-sm-6">
                <label for="date" class="col-form-label" style="font-size:14px">Fecha</label>
                <input type="date"name="date" class="form-control" id="date" style="font-size:12px" value="{{date('Y-m-d')}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                <label for="time" class="col-form-label" style="font-size:14px">Hora</label>
                <input type="time"name="time" class="form-control" id="time" style="font-size:12px" value="{{date('Y-m-d')}}">
            </div>
            <div class="col-sm-6" >
                <label for="event_type_id" class="col-form-label" style="font-size:14px">Tipo de evento</label>
                <select class="form-select" name="event_type" style="font-size:12px" id="event_type">
                    @foreach ($event_types as $type)
                    <option value="{{$type->id}}" {{$type->id==old('event_type')?'selected':''}}>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12" >
                <label for="remark" class="col-form-label" style="font-size:14px">Comentarios</label>
                <textarea name="remark" class="textarea form-control"  onfocus="quitarEspacios(this)" onblur="quitarEspacios(this)"  id="remark" cols="30" rows="10">
                    {{old('remak')}}
                </textarea>

            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar </button>


    </form>
    </div>
</div>
<div style="padding-top :5px">
    <a title="Regresar" href="{{url('/events')}}" class="btn btn-primary">
        <i class="fa-solid fa-arrow-left" ></i>
    </a>
</div>
@endsection
