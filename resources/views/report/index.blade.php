@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('report.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('report.index.subtitle')}}</small></h1>
        </div>
        @if(count($sales) > 0)
        <div class="card">
            <div class="card-header d-flex justify-content-between px-1 px-md-3">
                <div class="input-group col-10 pl-0">
                    <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('report.index.search')}}" aria-label="{{__('report.index.search')}}" aria-describedby="basic-addon2">
                    
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="">
                        <tr>
                            <td scope="col">{{__('report.code')}}</td>
                            <td scope="col">{{__('report.ticket')}}</td>
                            <td scope="col">{{__('report.subtotal')}}</td>
                            <td scope="col">{{__('report.igv')}}</td>
                            <td scope="col">{{__('report.total')}}</td>
                            <td scope="col">{{__('report.pay')}}</td>
                            <td scope="col" class="d-none d-md-table-cell">{{__('report.created')}}</td>
                        </tr>
                    </thead>
                    <tbody id="reportTable">
                        
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <h2 class="text-right">Total en ganancia: <small>S/{{number_format($total,2,'.',' ')}}</small></h2>
            </div>
        </div>
        @else
            <h3 class="text-danger font-weight-light">{{__('report.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('report.create')}}"><i class="fas fa-plus"></i> {{__('report.index.new')}}</a>
        @endif
        

        <script>
        $.ajaxSetup({ headers: {'csrftoken' : '@csrf' } });
        </script>
        <script>
            $(document).ready(function(){

                fetch_report_data();
                function fetch_report_data(query = '')
                {
                    
                    $.ajax({
                        url:"{{route('report.search')}}",
                        method:'GET',
                        data:{query:query},
                        dataType:'json',
                        success:function(data)
                            {
                                $('#reportTable').html(data.table_data);
                                //$('#total_records').text(data.total_data);
                            }
                    });
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    fetch_report_data(query);
                });
            });
        </script>
    </div>
@endsection