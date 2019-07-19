@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1">
            <h3 class="d-none d-lg-block">{{__('expense.show.title')}}</h3>
            <a class="btn btn-info" href="{{route('expense.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
    
        <div class="card">
            <div class="card-header bg-gray">
                <div class="row">
                    <h4 class="col-7">{{$expense->type}} <small class="text-muted"></h4>
                    
                </div>
                <hr/>
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('expense.show.created')}}:</span> {{ $expense->created_at }}</p>
                </div>
                
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('expense.show.updated')}}:</span> {{ $expense->updated_at }}</p>
                </div>
                @if ($expense->type == 'SUPPLY')
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('expense.show.type_suply')}}:</span> {{ $expense->supply_code }}</p>
                </div>
                @endif

                @if ($expense->type == 'EVOUCHERS')
                <div class="row">
                    <p class="col"><span class="font-weight-bold">{{__('expense.show.user')}}:</span> {{ $expense->user_code }}</p>
                </div>
                @endif
            </div>

            <div class="card-body p-0 pt-1">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3>{{__('expense.show.description')}}</h3>
                </div>
                
                <div class="card-body table-responsive p-1">
                
                        <h3> {{$expense->description}}</h3>
                    
                </div>

            </div>
            
        </div>


    </div>

@endsection