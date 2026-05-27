@extends('Shared.layout')
@section('title','Solicitud de credito')
@section('content')
<style>
     ol.progtrckr {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    ol.progtrckr li {
        display: inline-block;
        text-align: center;
        line-height: 3em;
    }

    ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
    ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
    ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
    ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
    ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
    ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
    ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
    ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

    ol.progtrckr li.progtrckr-done {
        color: black;
        border-bottom: 4px solid yellowgreen;
    }
    ol.progtrckr li.progtrckr-todo {
        color: silver;
        border-bottom: 4px solid silver;
    }

    ol.progtrckr li:after {
        content: "\00a0\00a0";
    }
    ol.progtrckr li:before {
        position: relative;
        bottom: -2.5em;
        float: left;
        left: 50%;
        line-height: 1em;
    }
    ol.progtrckr li.progtrckr-done:before {
        content: "\2713";
        color: white;
        background-color: yellowgreen;
        height: 1.2em;
        width: 1.2em;
        line-height: 1.2em;
        border: none;
        border-radius: 1.2em;
    }
    ol.progtrckr li.progtrckr-todo:before {
        content: "\039F";
        color: silver;
        background-color: white;
        font-size: 1.5em;
        bottom: -1.6em;
    }

.acordion {
  background-color:rgb(0, 82, 94);
  color: hsl(0, 0%, 100%);
  border-radius:
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  border: white 1px solid;


}

.activo, .acordion:hover {
  background-color: #ccc;
  color: black
}

.panel {
    border: rgb(0, 82, 94) 1px solid;
  padding: 18px 18px 18px 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>

<div style="padding-bottom:5px">
    @if($client==null)
    <form action="{{url('/clients/0')}}" autocomplete="off" method="GET" autocapitalize="off" class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        @if(auth()->check())
        <div class="input-group">
            <input type="text" id="client_identification" class="form-control" name="name_last_name" placeholder="Digite su nombre completo" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <input name="identification" id="identification" class="form-control" type="hidden" placeholder="Digite su CC" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit "><i class="fas fa-search"></i></button>
        </div>
        @else
        <div class="input-group">
            <input name="identification" id="identification" class="form-control" type="text" placeholder="Digite su CC" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit "><i class="fas fa-search"></i></button>
        </div>
        @endif
    </form>
    @endif
</div>
<div  style="padding-bottom:5px">
    <div id="progressInfo" ></div>
</div>
<div style="padding-bottom:10px">
    <ol class="progtrckr" data-progtrckr-steps="7">
        <li id="step1" title="Informacion personal"  class="sm progtrckr-todo"><i class="fas fa-user-tie"></i></li>
        <li id="step2" title="Informacion de contacto" class="sm progtrckr-todo"><i class="fas fa-address-book"></i></li>
        <li id="step3" title="Informacion laboral" class="sm progtrckr-todo"><i class="fas fa-briefcase"></i></li>
        <li id="step4" title="Informacion patrimonial" class="sm progtrckr-todo"><i class="fas fa-piggy-bank"></i></li>
        <li id="step5" title="Informacion legal" class="sm progtrckr-todo"><i class="fas fa-gavel"></i></li>
        <li id="step6" title="Acerca del credito" class="sm progtrckr-todo"><i class="fa-solid fa-hand-holding-dollar"></i></li>
        <li id="step7" title="Terminos y condiciones" class="sm progtrckr-todo"><i class="fas fa-file-contract"></i></li>
    </ol>
</div>
<div style="padding-top :10px ">
    @include('Shared.accordionClient')
</div>
<div style="padding-top:5px;padding-bottom:5px; ">
    <div id="ProgressBar"></div>
</div>
<div style="padding-top:5px;padding-bottom:5px">
    @if (auth()->check())
    <a class="btn btn-primary" title="Regresar" href="{{url('/clients')}}">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    @endif
</div>


<!--<div class="card">
    <div id="ProgressBar"></div>
    <div style="padding-bottom: 5px;padding-top:5px; ">
        @include('Shared.accordionClient')
    </div>

    <div style="padding-top:5px;padding-bottom:5px">
        @if (auth()->check())
        <a class="btn btn-primary" title="Regresar" href="{{url('/clients')}}">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        @endif
        <a href="{{url('/clients')}}/{{$client!=null?$client->id:0}}" class="btn btn-primary ms-auto me-0 me-md-3 my-2 my-md-0">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>&nbsp;Enviar solicitud
        </a>

    </div>

</div>-->
<script type="text/javascript">
var info= document.getElementById('info');
var cards=document.getElementsByClassName('card');
var progressInfo=document.getElementById('progressInfo');

var card=document.getElementById( info.value);
var i=parseInt( info.value);

progressInfo.innerHTML='Paso '+i+' de '+cards.length;
card.style.display='block';

</script>
@endsection
