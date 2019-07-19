@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('provider.edit.title')}}</h3> <a class="btn btn-info" href="{{route('provider.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
           <strong> {{__('provider.edit.cardheader')}}</strong>
        </div>
        <div class="card-body">
            <form action="{{route('provider.update', ['id' => $provider->id])}}" method="POST" class="form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col">
                        <label for="inputCode">{{__('provider.edit.code')}}</label>
                        <input type="text" class="form-control" placeholder="Code Example: LCL145" id="inputCode" name="code" value="{{$provider->code}}">
                    </div>
                    <div class="col">
                        <label for="inputName">{{__('provider.edit.name')}}</label>
                        <input type="text" class="form-control" placeholder="Leche Gloria SAC" id="inputName" name="name" value="{{$provider->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">{{__('provider.edit.address')}}</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Av. St. 1236" name="address" value="{{$provider->address}}">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="inputRuc">{{__('provider.edit.ruc')}}</label>
                        <input type="text" class="form-control" placeholder="12345678987" id="inputRuc" name="ruc" value="{{$provider->ruc}}">
                    </div>
                    <div class="col">
                        <label for="inputPhone">{{__('provider.edit.phone')}}</label>
                        <input type="text" class="form-control" placeholder="987654321" id="inputPhone" name="phone" value="{{$provider->phone}}">
                    </div>
                </div>
                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('provider.edit.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection