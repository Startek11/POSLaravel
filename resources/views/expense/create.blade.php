@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('expense.create.title')}}</h3> <a class="btn btn-info" href="{{route('expense.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('expense.create.cardheader')}}
        </div>
        <div class="card-body">
            <form action="{{route('expense.store')}}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <label for="inputDes">{{__('expense.create.description')}}</label>
                        <input type="text" class="form-control" placeholder="Cafe con leche" id="inputDes" name="description" value="{{ old('description')}}">
                    </div>
                </div>
                <div class="form-group">
                   
                    <label for="inputType">{{__('expense.create.type')}}</label>
                    <select id="inputType" class="form-control selectSearch" name="type" value="{{ old('type') }}">
                        <option value="SUPPLY">{{__('expense.create.supply')}}</option> 
                        <option value="EVOUCHERS">{{__('expense.create.evouchers')}}</option> 
                        <option value="SERVICES">{{__('expense.create.services')}}</option> 
                    </select>
                </div>
                @if('SUPPLY' == 'SUPPLY')
                    <label for="inputSupply">{{__('expense.create.supply')}}</label> 
                    <select id="inputSupply" class="form-control selectSearch" name="supply_code" value="{{ old('supply_code') }}"> 
                    @foreach($supplies as $supply)
                        <option value="supply_code">{{$supply->name}}</option> 
                    @endforeach 
                    </select>
                @endif

                <div class="col">
                        <label for="inputTotal">{{__('product.create.total')}}</label>
                        <input type="number" class="form-control" placeholder="Total Example: 400" id="inputTotal" name="total" value="{{ old('total')}}">
                 </div>
                 <div class="col">
                        <label for="inputCant">{{__('product.create.cant')}}</label>
                        <input type="number" class="form-control" placeholder="Cant Example: 4" id="inputCant" name="cant" value="{{ old('cant')}}">
                 </div>

                <div class="form-group mt-3 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('expense.create.submit')}}</button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection