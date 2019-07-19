@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('client.create.title')}}</h3> <a class="btn btn-info" href="{{route('client.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('client.create.cardheader')}}
        </div>
        <div class="card-body">
            <form action="{{ route('client.store') }}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <label for="inputName">{{__('client.create.name')}}</label>
                        <input type="text" class="form-control" placeholder="Roberto Alfredo" id="inputName" name="name" value="{{ old('name')}}">
                    </div>
                    <div class="col">
                        <label for="inputLastName">{{__('client.create.lastname')}}</label>
                        <input type="text" class="form-control" placeholder="Martinez Pastor" id="inputLastName" name="lastname" value="{{ old('lastname')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">{{__('client.create.address')}}</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Av. St. 1236" name="address" value="{{ old('address') }}">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="inputDocument">{{__('client.create.document')}}</label>
                        <input type="text" class="form-control" placeholder="71858942" id="inputDocument" name="document" value="{{ old('document')}}">
                    </div>
                    <div class="col">
                        <label for="inputPhone">{{__('client.create.phone')}}</label>
                        <input type="text" class="form-control" placeholder="987654321" id="inputPhone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('client.create.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection