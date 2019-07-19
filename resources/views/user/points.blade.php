@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <h3 class="d-none d-lg-block">{{__('user.points.title')}} <small class="text-muted">{{$user->names}}</small></h3>
        <a class="btn btn-info" href="{{route('user.index')}}"><i class="fas fa-arrow-left"></i></a>
    </div>
    @include('common.errors')
    <div class="card">
        <div class="card-header">
            {{__('user.points.cardtitle')}}
        </div>
        <div class="card-body">
            <form action="{{ route('user.setpoints',['id' => $user->id]) }}" class="border p-3" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group mb-2">
                    <label for="inputReason">{{__('user.points.reason')}}</label>
                    <input type="text" name="reason" id="inputReason" value="{{old('reason')}}" class="form-control" required autocomplete="off" autofocus>
                </div>
                <div class="form-group mb-3">

                    <div class="row px-3 mb-3">
                        <div class="col pl-5">
                            <p class="m-0">{{__('user.points.option')}}</p>
                            <div>
                                <input class="form-check-input" type="radio" name="option" id="inputAdd" value="ADD" onclick="add()" checked>
                                <label class="form-check-label text-success font-weight-bold" for="inputAdd">
                                    {{__('user.points.add')}}
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="option" id="inputRemove" value="REMOVE" onclick="remove()">
                                <label class="form-check-label text-danger font-weight-bold" for="inputRemove">
                                    {{__('user.points.remove')}}
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="inputCant">{{__('user.points.cant')}}</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div id="inputCantPrefi" class="input-group-text text-success"><i class="fas fa-plus"></i></div>
                                </div>
                                <input type="text" class="form-control" id="inputCant" name="cant" value="{{old('cant')}}" autocomplete="off" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col">
                            <button type="submit" class="btn btn-block btn-success"><i class="fas fa-save"></i> {{__('user.points.submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    function add(){
        $("#inputCantPrefi").removeClass("text-danger");
        $("#inputCantPrefi").addClass("text-success");
        $("#inputCantPrefi").html("<i class='fas fa-plus'></i>");
    }
    function remove(){
        $("#inputCantPrefi").removeClass("text-success");
        $("#inputCantPrefi").addClass("text-danger");
        $("#inputCantPrefi").html("<i class='fas fa-minus'></i>");
    }
</script>
@endsection