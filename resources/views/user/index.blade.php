@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('user.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('user.index.subtitle')}}</small></h1>
        </div>
        @if(count($users) > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between px-1 px-md-3">
                <div class="input-group col-10 pl-0">
                    <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('user.index.search')}}" aria-label="{{__('user.index.search')}}" aria-describedby="basic-addon2">
                    
                </div>
                <a class="btn btn-primary float-right" role="button" href="{{route('user.create')}}"><i class="fas fa-plus"></i> <span class="d-none d-md-inline">{{__('user.index.create')}}</span></a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="">
                        <tr>
                            <td scope="col">{{__('user.document')}}</td>
                            <td scope="col">{{__('user.names')}}</td>
                            <td scope="col" class="d-none d-md-table-cell">{{__('user.phone')}}</td>
                            <td scope="col" class="d-none d-md-table-cell text-center">{{__('user.pointsI')}}</td>
                            <td scope="col" class="text-center">{{__('user.index.actions')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h3 class="text-danger font-weight-light">{{__('user.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('user.create')}}"><i class="fas fa-plus"></i> {{__('user.index.create')}}</a>
        @endif
        

        <!--Live Search Script AJAX-->
        <script>
            $(document).ready(function(){

                fetch_user_data();
                function fetch_user_data(query = '')
                {
                    $.ajax({
                    url:"{{ route('user.search') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                        {
                            $('tbody').html(data.table_data);
                            $('#total_records').text(data.total_data);
                        }
                    })
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    fetch_user_data(query);
                });
            });
        </script>
        <script>
             $.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    </div>
@endsection