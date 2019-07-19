@extends('saleroom.index')

@section('table')
<style>
    #widthModal{
        max-width: 600px !important;
    }
</style>
<script>
        function verifyRadio(radio){
            if(radio == 'CASH'){
                $('#cash').prop('disabled',false);
            }
            if(radio == 'CARD'){
            
                $('#btnPay').prop('disabled',);
                $('#cash').prop('disabled',true);
            }
            if(radio == 'BOTH'){
                $('#cash').prop('disabled',false);
            }
        }
</script>
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h4>{{__('salesroom.tables')}}{{$cTable->number}}
        @if(isset($ticket)) 
            <span class="badge badge-danger">{{__('salesroom.unavailable')}}</span>
        @else 
            <span class="badge badge-success">{{__('salesroom.available')}}</span>
        @endif
        </h4>

        @if(isset($ticket))
            <h4>Ticket: {{$ticket->code}}</h4>
        @endif
    </div>
    <hr/>
    @if(isset($ticket))
        <div class="row justify-content-between">
            <div class="col-12 col-md-9">
            @include('common.errors')
                <div class="card">
                    <div class="card-header">
                        <form action="{{route('ticket.addProduct',['id' => $ticket->id])}}" method="post" class="row align-items-center">
                            @csrf
                            <select name="product" id="productList" class="col-7 col-sm-8 col-md-9 form-control searchSelect" required>
                                <option></option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">
                                        {{$product->code." || ".$product->description}}
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control col-3 col-sm-2 col-md-2 mx-1" name="cant" value="{{ old('cant')}}" required>
                            <button type="submit" class="col btn btn-primary"><i class="fas fa-plus"></i></button>
                        </form>
                    </div> 
                    <div class="card-body p-1 table-responsive" id="tableDetails">
                        @if(count($ticket->products)>0)
                            <table class="table table-sm mt-1 table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('salesroom.code')}}</th>
                                        <th scope="col">{{__('salesroom.description')}}</th>
                                        <th scope="col">{{__('salesroom.price')}}</th>
                                        <th scope="col" class="text-center">{{__('salesroom.quantity')}}</th>
                                        <th scope="col" class="text-right">{{__('salesroom.subtotal')}}</th>
                                        <th scope="col" class="text-center">{{__('salesroom.option')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ticket->products as $product)
                                        <tr>
                                            <td>{{$product->code}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>s/{{number_format($product->price,2,'.',' ')}}</td>
                                            <td class="text-center">{{$product->pivot->cant}}</td>
                                            <td class="text-right">s/{{number_format($product->pivot->total,2,'.',' ')}}</td>
                                            <td class="text-center">
                                                <form action="{{route('ticket.removeProduct',['idTicket' => $ticket->id,'idProduct' => $product->id])}}" method="post">
                                                @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{__('salesroom.empty')}}</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <strong class="float-right">{{__('salesroom.total')}}<span class=""> s/{{number_format($total,2,'.',' ')}} </span> </strong>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 align-self-center">
                <button class="btn btn-primary btn-block mb-2" @if(count($ticket->products)<=0) disabled @endif data-toggle="modal" data-target="#payTicketModal" id="buttonPay"> 
                    <i class="fas fa-shopping-cart"></i> {{__('salesroom.charge')}}
                </button>
                <form action="{{route('ticket.cancel',['id' => $ticket->id])}}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure? If you cancel this ticket the items will delete')" @if(count($ticket->products)>0) disabled @endif> <i class="fas fa-ban"></i> {{__('salesroom.cancel')}}</button>
                </form>
            </div>
        </div>
    @else
        <p>{{__('salesroom.order')}}</p>
        <a class="btn btn-primary" href="{{route('ticket.create',['id' => $cTable->id])}}"><i class="fas fa-plus"></i> {{__('salesroom.ticket')}}</a>
    @endif
</div>
<!-- MODAL PAY TICKET -->
@if($ticket!=null)
<div class="modal fade" id="payTicketModal" tabindex="-1" role="dialog" aria-labelledby="payTicketCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" id="widthModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalLongTitle">{{__('salesroom.summary')}} <small class="text-muted">Ticket: {{$ticket->code}}</small></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="tableDetailsModal">
        <div class="alert alert-danger bg-white text-danger" role="alert">
            {{__('salesroom.alert')}}
        </div>
        <div class="card p-0">
            <div class="card-body p-0" id="ticketDetails">

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('sale.make',['id' => $ticket->id])}}" method="post" id="formPay">
                @csrf
                    <div class="row">
                        <div class="col-6">
                            <p class="font-weight-bold mb-0">{{__('salesroom.metod')}} </p>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="cashPay" class="custom-control-input" name="payMethod" value="CASH" onclick="verifyRadio('CASH');" checked>
                                <label class="custom-control-label" for="cashPay">
                                    <i class="fas fa-money-bill-alt text-success"></i> {{__('salesroom.cash')}}
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="creditCard" class="custom-control-input" value="CARD" name="payMethod" onclick="verifyRadio('CARD');">
                                <label class="custom-control-label" for="creditCard">
                                    <i class="fas fa-credit-card text-warning"></i> {{__('salesroom.card')}}
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="bothPay" class="custom-control-input" value="BOTH" name="payMethod" onclick="verifyRadio('BOTH');">
                                <label class="custom-control-label" for="bothPay">
                                    <i class="fab fa-apple-pay text-primary"></i> {{__('salesroom.both')}}
                                </label>
                            </div>
                        </div>
                        <div class="col align-self-center">
                            <div class="my-1">
                                <label class="sr-only" for="cash">{{__('salesroom.cashr')}} </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">S/</div>
                                    </div>
                                    <input type="number" step=".01" class="form-control" name="cash" placeholder="{{__('salesroom.cashr')}}" id="cash">
                                </div>
                            </div>
                            <div class="my-1">
                                <label class="sr-only" for="turned">{{__('salesroom.turned')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">S/</div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Vuelto" id="turned" disabled>
                                </div>
                            </div>
                            <div class="my-1">
                                <label class="sr-only" for="document">{{__('salesroom.document')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-transparent"><i class="fas fa-address-card"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="ID" id="document" name="document" maxlength="8">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('salesroom.cancel2')}}</button>
        <button type="button" class="btn btn-primary" id="btnPay">{{__('salesroom.pay')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- ENDMODAL -->

<!-- CODE AJAX TO MODAL -->

<script>
    $(document).ready(function(){
        $('#buttonPay').on('click',function(){
            $('#ticketDetails').load("{{route('ticket.summary',['id' => $ticket->id])}}",function(){
                $('#payTicketModal').modal({show:true});
            });
        });
        $(document).on('keyup', '#cash', function(){
            var radio = $('input:radio[name=payMethod]:checked').val();
            var data = $(this).val();
            var turned = 0;
            if(radio == 'CASH'){
                if(data < total){
                    turned = "{{__('salesroom.need')}}";
                }else{
                    turned = data-total;
                }
            }
            if(radio == 'BOTH'){
                if(data <= total && data > 0){
                    turned = "{{__('salesroom.rest')}}";
                }else{
                    turned = "{{__('salesroom.novalid')}}";
                }
            }
            $('#turned').val(turned);
        });
        $('#btnPay').click(function(){
            $('#formPay').submit();
        });
    });
</script>
@endif
<!-- ENDCODE -->
@endsection