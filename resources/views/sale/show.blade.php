@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
            <h2 class="d-none d-lg-block">{{__('sale.summary')}} <small class="text-muted">{{$sale->code}}</small> </h2>
            <a class="btn btn-info" href="{{route('report.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('sale.ticketSummary')}} <small class="text-muted">Ticket: {{$ticket->code}}</small></h5>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-borderless table-sm mb-0">
                        <thead>
                            <th scope="col">N°</th>
                            <th scope="col">{{__('salesroom.description')}}</th>
                            <th scope="col">{{__('salesroom.unit')}}</th>
                            <th scope="col">{{__('salesroom.quantity')}}</th>
                            <th scope="col">{{__('salesroom.totalPrice')}}</th>
                        </thead>
                        <tbody>
                            <?php $number = 1; $total=0; $subtotal=0; $igv=0; ?>
                            @foreach($ticket->products as $product)
                                <tr>
                                    <td>{{$number}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>S/{{number_format($product->price,2,'.',' ')}}</td>
                                    <td>{{$product->pivot->cant}}</td>
                                    <td>S/{{number_format($product->pivot->total,2,'.',' ')}}</td>
                                </tr>
                                <?php $number++; $total += $product->pivot->total; ?>
                            @endforeach
                                <?php $igv = $total * 0.18; $subtotal = $total-$igv; ?>
                                <tr class="bg-light">
                                    <td colspan="4" class="font-weight-bold text-right">Sub Total: </td>
                                    <td>S/{{number_format($subtotal,2,'.',' ')}}</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="4" class="font-weight-bold text-right">I.G.V(18%): </td>
                                    <td>S/{{number_format($igv,2,'.',' ')}}</td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="4" class="font-weight-bold text-right">TOTAL: </td>
                                    <td>S/{{number_format($total,2,'.',' ')}}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('sale.info')}}</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <td><strong>{{__('sale.pTicket')}}</strong></td>
                                <td>{{$pTicket->code}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('sale.clientDocument')}}</strong></td>
                                <td>{{$pTicket->client_document}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('sale.clientName')}}</strong></td>
                                <td>{{$pTicket->client_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('sale.payMethod')}}</strong></td>
                                <td>{{$sale->payMethod}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('sale.moneyCash')}}</strong></td>
                                <td>S/{{number_format($sale->moneyCash,2,'.',' ')}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('sale.moneyCard')}}</strong></td>
                                <td>S/{{number_format($sale->moneyCard,2,'.',' ')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection