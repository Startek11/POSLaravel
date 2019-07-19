@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('provider.create.title')}}</h3> <a class="btn btn-info" href="{{route('provider.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('provider.create.cardheader')}}
        </div>
        <div class="card-body">
            <form action="{{route('provider.store')}}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <label for="inputCode">{{__('provider.create.code')}}</label>
                        <input type="text" class="form-control" placeholder="Code Example: LGL145" id="inputCode" name="code" value="{{ old('code')}}">
                    </div>
                    <div class="col">
                        <label for="inputName">{{__('provider.create.name')}}</label>
                        <input type="text" class="form-control" placeholder="Leche Gloria SAC" id="inputName" name="name" value="{{ old('name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">{{__('provider.create.address')}}</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Av. St. 1236" name="address" value="{{ old('address') }}">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="inputRuc">{{__('provider.create.ruc')}}</label>
                        <input type="text" class="form-control" placeholder="RUC: 10297187412" id="inputRuc" name="ruc" value="{{ old('ruc')}}">
                    </div>
                    <div class="col">
                        <label for="inputPhone">{{__('provider.create.phone')}}</label>
                        <input type="text" class="form-control" placeholder="987654321" id="inputPhone" name="phone" value="{{ old('phone')}}">
                    </div>
                </div>

                
                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('provider.create.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection