 <label for="date" class="col-form-label" style="font-size:14px">Cliente</label>
 <input type="text" name="client"  class="client form-control" id="client_name" value="{{$client_name ?? $client?->reference}}" style="font-size:12px;">
 <input type="hidden" id="client_id" value="{{$client_id ?? $client?->id }}" name="client_id">
                      <!--  <button title="Buscar cliente" class="btn btn-success">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>-->

