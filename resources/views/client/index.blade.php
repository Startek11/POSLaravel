@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('client.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('client.index.subtitle')}}</small></h1>
        </div>
        @if(count($clients) > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between px-1 px-md-3">
                <div class="input-group col-10 pl-0">
                    <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('client.index.search')}}" aria-label="{{__('client.index.search')}}" aria-describedby="basic-addon2">
                    
                </div>
                <a class="btn btn-primary float-right" role="button" href="{{route('client.create')}}"><i class="fas fa-plus"></i> <span class="d-none d-md-inline">{{__('client.index.new')}}</span></a>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="">
                        <tr>
                            <td scope="col">{{__('client.document')}}</td>
                            <td scope="col">{{__('client.index.table.fullname')}}</td>
                            <td scope="col" class="d-none d-md-table-cell">{{__('client.created')}}</td>
                            <td scope="col" class="d-none d-md-table-cell">{{__('client.updated')}}</td>
                            <td scope="col">{{__('client.index.table.actions')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h3 class="text-danger font-weight-light">{{__('client.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('client.create')}}"><i class="fas fa-plus"></i> {{__('client.index.new')}}</a>
        @endif
        

        <!--Live Search Script AJAX-->
        <script>
            $(document).ready(function(){

                fetch_customer_data();
                function fetch_customer_data(query = '')
                {
                    $.ajax({
                    url:"{{ route('client.search') }}",
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
                    fetch_customer_data(query);
                });
            });
        </script>
        <script>
             $.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    </div>
@endsection