@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('client.edit.title')}}</h3> <a class="btn btn-info" href="{{route('supply.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
           <strong> {{__('supply.edit.cardheader')}}</strong>
        </div>
        <div class="card-body">
            <form action="{{route('supply.update', ['id' => $supply->id])}}" method="POST" class="form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col">
                        <label for="inputCode">{{__('supply.edit.code')}}</label>
                        <input type="text" class="form-control" placeholder="SPL145" id="inputCode" name="code" value="{{ $supply->code }}">
                    </div>
                    <div class="col">
                        <label for="inputName">{{__('supply.edit.name')}}</label>
                        <input type="text" class="form-control" placeholder="Leche Eva. 150ml" id="inputName" name="name" value="{{ $supply->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="inputDescription">{{__('supply.edit.description')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('supply.create.descPH')}}" id="inputDescription" name="description" value="{{ $supply->description }}">
                    </div>
                    <div class="col">
                        <label for="providerList">
                            {{__('supply.edit.provider')}}
                            </label>
                            <select name="providerID" id="providerList" class="searchSelect form-control js-example-basic-single js-states form-control">
                                    <option></option>
                                @foreach($providers as $provider)
                                    @if($provider->id == $supply->provider->id)
                                    <option value="{{$provider->id}}" selected="true">{{$provider->code}}-{{$provider->name}}</option>
                                    @else
                                    <option value="{{$provider->id}}">{{$provider->code}}-{{$provider->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <label for="inputStock">{{__('supply.edit.stock')}}</label>
                        <input type="text" class="form-control" placeholder="15" id="inputStock" name="stock" value="{{$supply->stock}}">
                    </div>
                    <div class="col">
                        <label for="inputUnitPrice">{{__('supply.edit.unitPrice')}}</label>
                        <input type="text" class="form-control" placeholder="7.50" id="inputUnitPrice" name="unitPrice" value="{{ $supply->unitPrice }}">
                    </div>
                </div>
                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('supply.edit.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>


@endsection