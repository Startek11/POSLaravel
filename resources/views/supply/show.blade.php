@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1 col-12 col-lg-7 mx-auto">
            <h3 class="d-none d-lg-block">{{__('supply.show.title')}} <span class="text-muted">{{ $supply->name }}</span></h3>
            <a class="btn btn-info" href="{{route('supply.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
        
        <div class="card col-12 col-lg-6 mx-auto">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h3 class="text-danger">
                    {{__('supply.show.information')}}
                </h3>
                <div>
                    <a href="{{ route('supply.edit',['id' => $supply->id]) }}" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                </div>
            </div>
            <div class="card-body">
                <p><span class="font-weight-bold">{{ __('supply.code') }}:</span> <span class=" float-right">{{ $supply->code }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('supply.name') }}:</span> <span class="float-right">{{ $supply->name }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('supply.description') }}:</span> <span class="float-right">{{ $supply->description }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('supply.provider') }}:</span> <span class="float-right">{{ $supply->provider->name }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('supply.stock') }}:</span> <span class="float-right">{{ $supply->stock }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('supply.unitPrice') }}:</span> <span class="float-right">s/{{ number_format($supply->unitPrice,2,'.',' ') }}</span></p>
            </div>
        </div>


    </div>

@endsection