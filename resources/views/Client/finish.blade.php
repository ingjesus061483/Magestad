@extends('Shared/layout')
@section('title','Formulario de solicitud de credito')
@section('content')
<div style="padding-bottom: 5px">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-id-card"></i>
                ANEXOS
            </div>
            <div class="card-body">
                Estimado Sr(a) <strong> {{$client->name_last_name}}</strong>, buenas tardes, Gracias por diligenciar el formulario 👍
                Validaremos la información anterior
                y nos contactaremos con usted a la mayor brevedad posible, para acordar el desembolso  y los términos de la negociación.
                Para finalizar este proceso, favor enviar al WhatsApp 300 676 6200 o adjuntar aquí 👇 los sgtes documentos para complementar dicha solicitud:
                <ul>
                        <li> Cédula de ciudadanía (ambos lados)</li>
                        <li> Desprendibles de pago (último mes)</li>
                        <li> Certificación laboral no mayor a 30 días</li>
                        <li> Recibo de servicio público</li>
                        <li> Carnet ARL afiliada.</li>
                </ul>
                Mil gracias.<br>
                <strong>Cesar Rodriguez CSSoluciones</strong>
            </div>
        </div>
</div>
<div style="padding-top:5px;padding-bottom:5px">
    @if (auth()->check())
    <a class="btn btn-primary" title="Regresar" href="{{url('/clients')}}">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    @endif
    <a title="Finalizar proceso" href="{{url('/')}}" class="btn btn-danger">
    <i class="fa-solid fa-flag-checkered"></i>
    </a>
</div>
@endsection
