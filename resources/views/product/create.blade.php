@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('product.create.title')}}</h3> <a class="btn btn-info" href="{{route('product.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('product.create.cardheader')}}
        </div>
        <div class="card-body">
            <form action="{{route('product.store')}}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <label for="inputCode">{{__('product.create.code')}}</label>
                        <input type="text" class="form-control" placeholder="Code Example: LGL145" id="inputCode" name="code" value="{{ old('code')}}">
                    </div>
                    <div class="col">
                        <label for="inputDes">{{__('product.create.description')}}</label>
                        <input type="text" class="form-control" placeholder="Cafe con leche" id="inputDes" name="description" value="{{ old('description')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPrice">{{__('product.create.price')}}</label>
                    <input type="number" class="form-control" id="inputPrice" placeholder="30" name="price" value="{{ old('price') }}">

                    <label for="inputType">{{__('product.create.type')}}</label>
                    <select id="inputType" class="form-control selectSearch" name="type" value="{{ old('type') }}">
                    @foreach($types as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->type}}</option> 
                    @endforeach
                    </select>
                </div>
                

                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('product.create.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection