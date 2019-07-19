@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('expense.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('expense.index.subtitle')}}</small></h1>
        </div>
        @if(count($expenses) > 0)
        
            <div class="card">

                <div class="card-header d-flex justify-content-between px-1 px-md-3">
                    <div class="input-group col-10 pl-0">
                        <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('expense.index.search')}}" aria-label="{{__('expense.index.search')}}" aria-describedby="basic-addon2">
                        
                    </div>
                    <a class="btn btn-primary float-right" role="button" href="{{route('expense.create')}}"><i class="fas fa-plus"></i> <span class="d-none d-md-inline">{{__('expense.index.new')}}</span></a>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="">
                            <tr>
                                <td scope="col">{{__('expense.id')}}</td>
                                <td scope="col">{{__('expense.description')}}</td>
                                <td scope="col ">{{__('expense.type')}}</td>
                               
                                <td scope="col ">{{__('expense.total')}}</td>
                                <td scope="col">{{__('expense.cant')}}</td>
                                <td scope="col" class="d-none d-md-table-cell">{{__('expense.created')}}</td>
                                
                            </tr>
                        </thead>
                        <tbody id="expenseTable">
                            
                        </tbody>
                    </table>
                </div>
            </div>    
         

                
           
        @else
            <h3 class="text-danger font-weight-light">{{__('expense.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('expense.create')}}"><i class="fas fa-plus"></i> {{__('expense.index.new')}}</a>
        @endif
        

       <!--Live Search Script AJAX-->
       
    </div>
   
    <script>
            $(document).ready(function(){

                fetch_expense_data();
                function fetch_expense_data(query = '')
                {
                    
                    $.ajax({
                        url:"{{route('expense.search')}}",
                        method:'GET',
                        data:{query:query},
                        dataType:'json',
                        success:function(data)
                            {
                                $('#expenseTable').html(data.table_data);
                                //$('#total_records').text(data.total_data);
                            }
                    });
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    fetch_expense_data(query);
                });
            });
        </script>
         <script>
        $.ajaxSetup({ headers: {'csrftoken' : '@csrf' } });
    </script>
@endsection