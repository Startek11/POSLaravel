@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1 col-12">
            <h3 class="d-none d-lg-block">{{__('provider.show.title')}} <span class="text-muted">{{ $provider->name }}</span></h3>
            <a class="btn btn-info" href="{{route('provider.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="d-flex flex-wrap">
            <div class="card col-12 col-lg-6">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="text-danger">
                        {{__('provider.show.information')}}
                    </h3>
                    <div>
                        <a href="{{ route('provider.edit',['id' => $provider->id]) }}" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <p><span class="font-weight-bold">{{ __('provider.code') }}:</span> <span class=" float-right">{{ $provider->code }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.ruc') }}:</span> <span class=" float-right">{{ $provider->ruc }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.name') }}:</span> <span class="float-right">{{ $provider->name }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.address') }}:</span> <span class="float-right">{{ $provider->address }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.phone') }}:</span> <span class="float-right">{{ $provider->phone }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.created') }}:</span> <span class="float-right">{{ substr($provider->created_at,0,10) }}</span></p>
                    <hr>
                    <p><span class="font-weight-bold">{{ __('provider.updated') }}:</span> <span class="float-right">{{ substr($provider->updated_at,0,10) }}</span></p>
                </div>
            </div>

            <div class="card col-12 col-lg-6">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3>{{__('provider.show.supplies')}}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        @if(count($provider->supplies) > 0)
                        <thead>
                            <th scope="col">{{__('provider.show.supplycode')}}</th>
                            <th scope="col">{{__('provider.show.supplyname')}}</th>
                            <th scope="col">{{__('provider.show.supplystock')}}</th>
                        </thead>
                        <tbody>
                            @foreach($provider->supplies as $supply)
                                <tr>
                                    <td scope="row">{{$supply->code}}</td>
                                    <td>{{$supply->name}}</td>
                                    <td>{{$supply->stock}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @else
                        <p class="text-center">{{__('provider.show.supplyempty')}}</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection