@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-lg-block">{{__('user.cpass.title')}}</h3>
        <a class="btn btn-info" href="{{route('user.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>{{__('user.cpass.cardTitle')}}</h4>
        </div>
        <div class="card-body">
            <p class="text-danger font-weight-bold">{{__('user.cpass.cardbodymes')}}</p>
            <form action="{{route('user.updatepass',['id' => $user->id])}}" method="post">
                @csrf
                {{method_field('PUT')}}
                <div class="row mb-2">
                    <div class="col">
                        <label for="inputPassword">{{__('user.cpass.newPassLabel')}}</label>
                        <input type="password" class="form-control" placeholder="{{__('user.cpass.newPass')}}" name="password" id="inputPassword">
                    </div>
                    <div class="col">
                        <label for="inputConfirmPassword">{{__('user.cpass.conPassLabel')}}</label>
                        <input type="password" class="form-control" placeholder="{{__('user.cpass.conPass')}}" name="password_confirmation" id="inputConfirmPassword">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-pen"></i> {{__('user.cpass.submit')}}</button>
            </form>

        </div>
    </div>
</div>
@endsection