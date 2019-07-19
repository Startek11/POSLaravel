@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('supply.create.title')}}</h3> <a class="btn btn-info" href="{{route('supply.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('supply.create.cardheader')}}
        </div>
        <div class="card-body">
            <form action="{{route('supply.store')}}" method="POST" class="form">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="row">
                    <div class="col">
                        <label for="inputCode">{{__('supply.create.code')}}</label>
                        <input type="text" class="form-control" placeholder="SPL145" id="inputCode" name="code" value="{{ old('code')}}">
                    </div>
                    <div class="col">
                        <label for="inputName">{{__('supply.create.name')}}</label>
                        <input type="text" class="form-control" placeholder="Leche Eva. 150ml" id="inputName" name="name" value="{{ old('name')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="inputDescription">{{__('supply.create.description')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('supply.create.descPH')}}" id="inputDescription" name="description" value="{{ old('description')}}">
                    </div>
                    <div class="col">
                        <label for="providerList">
                            {{__('supply.create.provider')}}
                        </label>
                        <select name="providerID" id="providerList" class="searchSelect form-control js-example-basic-single js-states form-control">
                            <option></option>
                            @foreach($providers as $provider)
                                <option value="{{$provider->id}}">{{$provider->code}}-{{$provider->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <label for="inputStock">{{__('supply.create.stock')}}</label>
                        <input type="text" class="form-control" placeholder="15" id="inputStock" name="stock" value="{{ old('stock')}}">
                    </div>
                    <div class="col">
                        <label for="inputUnitPrice">{{__('supply.create.unitPrice')}}</label>
                        <input type="text" class="form-control" placeholder="7.50" id="inputUnitPrice" name="unitPrice" value="{{ old('unitPrice') }}">
                    </div>
                </div>
                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('supply.create.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>


@endsection