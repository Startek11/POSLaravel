@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{__('salesroom.title')}} <small class="text-muted">{{__('salesroom.subtitle')}}</small></h3>
        <div class="card col-12 p-0">
            <div class="card-header"><h4>{{__('salesroom.table')}}</h4></div>
            <div class="card-body d-flex align-content-center justify-content-center flex-wrap" style="width=auto;">
                @foreach($tables as $table)
                    @if($table->number != 0)
                    <div class="card col-5 col-sm-3 col-xl-1 m-1 p-0">
                        <div class="card-body p-0 border rounded">
                            <a class=" @if(count($table->tickets()->where('active',1)->get()) > 0) btn-warning @else btn-primary @endif  p-0 m-0 btn btn-block" role="button" href="{{route('salesroom.table',['id' => $table->id]).'#tableDetails'}}">
                                <h4 class="text-white text-center">M{{$table->number}}</h4>
                                <span class="text-wrap text-white">
                                @if(count($table->tickets()->where('active',1)->get()) > 0)
                                    {{__('salesroom.details')}}
                                @else
                                    {{__('salesroom.open')}}
                                @endif
                                </span>
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer px-0 px-md-2">
            @yield('table')
            </div>
        </div>
        
    </div>
   
@endsection