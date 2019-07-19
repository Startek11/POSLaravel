@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1">
            <h3 class="d-none d-lg-block">{{__('product.show.title')}}</h3>
            <a class="btn btn-info" href="{{route('product.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
    
        <div class="card">
            <div class="card-header bg-gray">
                <div class="row">
                    <h4 class="col-7">{{$product->description}} <small class="text-muted">[{{$product->code}}]</small></h4>
                    
                </div>
                <hr/>
                
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('product.show.price')}}:</span> {{$product->price}}</p>

                    <p class="col"><span class="font-weight-bold">{{__('product.show.available')}}:</span> 
                         @if($product->available)
                            <i class="fas fa-circle text-success"></i> 
                        @else
                            <i class="fas fa-circle text-danger"></i> 
                        @endif
                    </p>

                </div>
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('product.show.createDate')}}:</span> {{ $product->created_at }}</p>
                    <p class="col"><span class="font-weight-bold">{{__('product.show.updated')}}:</span> {{ $product->updated_at }}</p>
                </div>
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('product.show.typeName')}}:</span> {{ $product->type->type }}</p>
                    
                </div>
            </div>

            <div class="card-body p-0 pt-1">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3>{{__('product.show.types')}}</h3>
                </div>
                
                <div class="card-body table-responsive p-1">
                
                        <button type="button" class="btn btn-info">{{$product->type->type}}</button>
                    
                </div>
            </div>
        </div>


    </div>

@endsection