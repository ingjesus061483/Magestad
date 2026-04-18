@extends('Shared/layout')
@section('title',' Solicitud de préstamo')
@section('content')
<a title="Crear solicitud de prestamo" href="{{url('/requestLoan/create')}}" class="btn btn-primary mb-3">
    <i class="fa-solid fa-plus"></i>

</a>
<div id="accordion">
    @foreach ($priorities as $item)

    <h3>
        <a
        @switch($item->id)
        @case(1)
            style="background-color:rgba(0, 100, 0, 0.8);color:white; border-radius: 10px;"
            @break
        @case(2)
            style="background-color:yellow;color:black; border-radius: 10px;"
            @break
        @case(3)
            style="background-color:rgba(217, 18, 18, 0.8);color:white; border-radius: 10px;"
             @break
            @break
        @default
    @endswitch >
        &nbsp;&nbsp;
    </a>
      <strong >&nbsp; {{explode(" | ", $item->name)[0]}} |</strong>&nbsp;{{explode(" | ", $item->name)[1]}},  ${{ number_format($item->loan_sum) }}
    </h3>
    <div>
        @switch($item->id)
            @case(1)
            @include('Shared.tableRequestLoan',['requestLoansPr'=>$requestLoansPr1])
                @break
            @case(2)
            @include('Shared.tableRequestLoan',['requestLoansPr'=>$requestLoansPr2])
                @break
            @case(3)
            @include('Shared.tableRequestLoan',['requestLoansPr'=>$requestLoansPr3])
                @break

        @endswitch

    </div>
    @endforeach
    <h3 >
        <a  style="background-color:rgba(0, 0, 255, 0.5);color:black; border-radius: 10px;">
            &nbsp;&nbsp;
        </a>&nbsp;
      <strong>  PR-T |</strong>  Todas las solicitudes, ${{ number_format($requestLoansAll->sum('amountRequested')) }}
    </h3>
    <div>
        @include('Shared.tableRequestLoan',['requestLoansPr'=>$requestLoansAll])

    </div>
</div>
@endsection
