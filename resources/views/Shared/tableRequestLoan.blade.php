  <table class="table table-hover table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th style="text-align:center">FECHA</th>
                        <th style="text-align: center" >NOMBRE DEL CLIENTE</th>
                        <th style="text-align: center" >MONTO SOLICITADO</th>
                        <th style="text-align: center" >STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requestLoansPr as $item)
                    <tr>
                        <td>
                            <a href="{{url('requestLoan')}}/{{$item->id}}/edit" class="btn btn-warning btn-sm" >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{url('requestLoan')}}/{{$item->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                               <button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="validar(this,'¿Desea eliminar el registro?')">
                                     <i class="fa-solid fa-trash"></i>
                               </button>
                            </form>
                        </td>
                        <td>{{date("d/m/Y", strtotime($item->date)) }}</td>
                        <td>{{ $item->clientName }}</td>
                        <td>${{ number_format($item->amountRequested) }}</td>
                        <td>{{ $item->priorityName }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
