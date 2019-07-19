@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-md-block">{{__('user.edit.title')}}</h3> <a class="btn btn-info" href="{{route('user.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('user.edit.cardtitle')}}
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', ['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row mb-1">
                    <div class="col">
                        <label for="inputNames">{{__('user.names')}}</label>
                        <input type="text" id="inputNames" class="form-control" name="names" value="{{$user->names}}" required autocomplete="names" autofocus>
                    </div>
                    <div class="col">
                        <label for="inputLastNames">{{__('user.lastnames')}}</label>
                        <input type="text" id="inputLastNames" class="form-control" name="lastnames" value="{{$user->lastnames}}" required autocomplete="lastnames">
                    </div>
                </div>  
                <div class="row mb-1">
                    <div class="col">
                        <label for="inputUsername">{{__('user.username')}}</label>
                        <input type="text" id="inputUsername" class="form-control" name="username" value="{{$user->username}}" required autocomplete="username" max-length="20">
                    </div>
                    <div class="col">
                        <label for="inputDocument">{{__('user.document')}}</label>
                        <input type="text" id="inputDocument" class="form-control" name="document" value="{{$user->document}}" required max-lenght="8" autocomplete="document">
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col-5">
                        <label for="inputEmail">{{__('user.email')}}</label>
                        <input type="email" id="inputEmail" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">
                    </div>
                    <div class="col">
                        <label for="inputAddress">{{__('user.address')}}</label>
                        <input type="text" id="inputAddress" class="form-control" name="address" value="{{$user->address}}" required autocomplete="address" max-length="50">
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col">
                        <label for="inputPhone">{{__('user.phone')}}</label>
                        <input type="text" id="inputPhone" class="form-control" name="phone" value="{{$user->phone}}" required autocomplete="phone" max-length="9">
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputBirthday">{{__('user.birthday')}}</label>
                            <input type='date' id="inputBirthday" class="datepicker form-control" name="birthday" value="{{$user->birthday}}" required autocomplete="birthday">
                        </div>
                    </div>
                </div> 
                <div class="row mb-3 px-1">
                    <p>{{__('user.image')}}</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file">
                        <label class="custom-file-label" for="file">{{__('user.imagechoose')}}</label>
                    </div>
                </div>
                <div class="form-group mt-2 mb-0 text-right">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> {{__('user.edit.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="container"></div>

@endsection