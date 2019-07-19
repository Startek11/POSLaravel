@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1 col-12 col-lg-8 mx-auto">
            <h3 class="d-none d-lg-block">{{__('client.show.title')}} <span class="text-muted">{{ $client->name }} [{{$client->id}}]</span></h3>
            <a class="btn btn-info" href="{{route('client.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
        
        <div class="card col-12 col-lg-6 mx-auto">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h3 class="text-danger">
                    {{__('client.show.information')}}
                </h3>
                <div>
                    <a href="{{ route('client.edit',['id' => $client->id]) }}" class="btn btn-success text-white btn-sm" role="button"><i class="fas fa-pen"></i></a>
                </div>
            </div>
            <div class="card-body">
                <p><span class="font-weight-bold">{{ __('client.document') }}:</span> <span class=" float-right">{{ $client->document }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.name') }}:</span> <span class="float-right">{{ $client->name }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.lastname') }}:</span> <span class="float-right">{{ $client->lastName }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.address') }}:</span> <span class="float-right">{{ $client->address }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.phone') }}:</span> <span class="float-right">{{ $client->phone }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.created') }}:</span> <span class="float-right">{{ substr($client->created_at,0,10) }}</span></p>
                <hr>
                <p><span class="font-weight-bold">{{ __('client.updated') }}:</span> <span class="float-right">{{ substr($client->updated_at,0,10) }}</span></p>
            </div>
        </div>


    </div>

@endsection