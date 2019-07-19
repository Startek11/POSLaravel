@extends('layouts.app')

@section('content')
    <div class="container px-0 px-md-3">
        <div class="d-flex justify-content-between mb-1">
            <h3 class="d-none d-lg-block">{{__('user.show.title')}}</h3>
            <a class="btn btn-info" href="{{route('user.index')}}"><i class="fas fa-arrow-left"></i></a>
        </div>
        @include('common.info')
        <div class="card">
            <div class="card-header bg-gray">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img src="{{asset('/storage/'.$user->file)}}" alt="Profile" width="300px" height="300px" class="rounded mx-auto d-block">
                        </div>
                        <div class="col-12 col-md-8">
                        <div class="row">
                        <h4 class="col-7">{{$user->names}} {{$user->lastnames}} <small class="text-muted">[{{$user->username}}]</small></h4>
                        <h4 class="col text-info text-right">{{__('user.pointsI')}} {{$user->points}}</h4>
                    </div>
                    <hr/>
                    <div class="row">
                        <p class="col"><span class="font-weight-bold">{{__('user.document')}}:</span> {{$user->document}}</p>
                        <p class="col"><span class="font-weight-bold">{{__('user.email')}}:</span> {{$user->email}}</p>
                    </div>
                    <div class="row">
                        <p class="col"><span class="font-weight-bold">{{__('user.address')}}:</span> {{$user->address}}</p>
                        <p class="col"><span class="font-weight-bold">{{__('user.phone')}}:</span> {{$user->phone}}</p>
                    </div>
                    <div class="row">
                        <p class="col"><span class="font-weight-bold">{{__('user.birthday')}}:</span> {{ $user->birthday }}</p>
                        <p class="col"><span class="font-weight-bold">{{__('user.createDate')}}:</span> {{ $user->created_at }}</p>
                    </div>
                    <div class="row">
                        <p class="col"><span class="font-weight-bold">{{__('user.active')}}:</span> 
                            @if($user->active)
                                <i class="fas fa-circle text-success"></i> {{__('user.activeT')}}
                            @else
                                <i class="fas fa-circle text-danger"></i> {{__('user.activeF')}}
                            @endif
                        </p>
                        <form action="@if($user->active){{route('user.disable',['id'=>$user->id])}}@else{{route('user.enable',['id'=>$user->id])}}@endif" method="post" class="col">
                            @csrf
                            {{method_field('PUT')}}
                            @if($user->active)
                                <button type="submit" class="btn btn-danger"><i class="fas fa-frown-open"></i> {{__('user.disableUser')}}</button>
                            @else
                                <button type="submit" class="btn btn-success"><i class="fas fa-smile-wink"></i> {{__('user.enableUser')}}</button>
                            @endif
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 pt-1 table-responsive">

                @if(count($user->behaviors) > 0)
                <table class="table table-hovered p-0">
                    <thead>
                        <th>{{__('user.show.behareason')}}</th>
                        <th>{{__('user.show.behatype')}}</th>
                        <th class="text-center">{{__('user.show.behapoints')}}</th>
                        <th class="text-right">{{__('user.show.behacreate')}}</th>
                    </thead>
                    @foreach($user->behaviors->sortByDesc('created_at') as $behavior)
                        <tr>
                            <td>{{$behavior->reason}}</td>
                            <td class="font-weight-bold @if($behavior->type == 'ADD') text-success @else text-danger @endif">
                                @if($behavior->type == 'ADD')
                                    {{__('user.show.behaadd')}}
                                @else
                                    {{__('user.show.beharemove')}}
                                @endif
                            </td>
                            @if($behavior->type == 'ADD')
                                <td class="text-center text-success font-weight-bold">+{{$behavior->cant}}</td>
                            @else
                                <td class="text-center text-danger font-weight-bold">-{{$behavior->cant}}</td>
                            @endif
                            <td class="text-right">{{$behavior->created_at}}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                <p class="text-muted text-center">{{__('user.show.behaempty')}}</p>
                @endif
            </div>
        </div>


    </div>

@endsection