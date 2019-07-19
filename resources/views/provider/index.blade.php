@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('provider.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('provider.index.subtitle')}}</small></h1>
        </div>
        @if(count($providers) > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between px-1 px-md-3">
                <div class="input-group col-10 pl-0">
                    <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('provider.index.search')}}" aria-label="{{__('provider.index.search')}}" aria-describedby="basic-addon2">
                    
                </div>
                <a class="btn btn-primary float-right" role="button" href="{{route('provider.create')}}"><i class="fas fa-plus"></i> <span class="d-none d-md-inline">{{__('provider.index.new')}}</span></a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="">
                        <tr>
                            <td scope="col">{{__('provider.code')}}</td>
                            <td scope="col">{{__('provider.ruc')}}</td>
                            <td scope="col">{{__('provider.index.table.name')}}</td>
                            <td scope="col" class="d-none d-md-table-cell">{{__('provider.created')}}</td>
                            <td scope="col">{{__('provider.index.table.actions')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h3 class="text-danger font-weight-light">{{__('provider.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('provider.create')}}"><i class="fas fa-plus"></i> {{__('provider.index.new')}}</a>
        @endif
        

        <!--Live Search Script AJAX-->
        <script>
            $(document).ready(function(){

                fetch_provider_data();
                function fetch_provider_data(query = '')
                {
                    $.ajax({
                    url:"{{ route('provider.search') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                        {
                            $('tbody').html(data.table_data);
                            //$('#total_records').text(data.total_data);
                        }
                    })
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    fetch_provider_data(query);
                });
            });
        </script>
        <script>
             $.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    </div>
@endsection