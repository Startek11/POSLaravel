@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Info is here -->
        @include('common.info')
        <!-- End Info-->
        <div>
            <h1>{{__('product.index.title')}}<small class="d-none d-md-inline text-muted h3 font-weight-light"> {{__('product.index.subtitle')}}</small></h1>
        </div>
        @if(count($products) > 0)
        <div class="row">
            <div class="card p-0 col-12 col-md-9">

                <div class="card-header d-flex justify-content-between px-1 px-md-3">
                    <div class="input-group col-10 pl-0">
                        <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="{{__('product.index.search')}}" aria-label="{{__('product.index.search')}}" aria-describedby="basic-addon2">
                        
                    </div>
                    <a class="btn btn-primary float-right" role="button" href="{{route('product.create')}}"><i class="fas fa-plus"></i> <span class="d-none d-md-inline">{{__('product.index.new')}}</span></a>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="">
                            <tr>
                                <td scope="col">{{__('product.code')}}</td>
                                <td scope="col">{{__('product.description')}}</td>
                                <td scope="col">{{__('product.price')}}</td>
                                <td scope="col" class="d-none d-md-table-cell">{{__('product.typeName')}}</td>
                                <td scope="col" class="text-center">{{__('product.index.actions')}}</td>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card ml-1 p-0 col-12 col-md">

                <div class="card-header px-1 px-md-3">
                    <form action="{{route('typeP.store')}}" method="post" class="d-flex justify-content-between">
                    @csrf
                        <div class="input-group col-10 pl-0">
                            <input type="text" class="form-control" autocomplete="off" id="inputType" name="type" placeholder="{{__('product.index.addType')}}" aria-label="{{__('product.index.search')}}" aria-describedby="basic-addon2">
                            
                        </div>
                        <button class="btn btn-success float-right" role="button" type="submit"><i class="fas fa-plus"></i></button>
                    </form>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <td scope="col" class="text-center">{{__('product.index.typeName')}}</td>
                            <td scope="col" class="text-center">{{__('product.index.typeDelete')}}</td>
                        </thead>
                        <tbody id="typeTable">
                            @foreach($types as $type)
                                <tr>
                                    <td class="text-center">{{$type->type}}</td>
                                    <td class="text-center">
                                        @if($type->id != 1)
                                        <form action="{{route('typeP.delete',['id' => $type->id])}}" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

                
           
        @else
            <h3 class="text-danger font-weight-light">{{__('product.index.empty')}}</h3>
            <a class="btn btn-primary" role="button" href="{{route('product.create')}}"><i class="fas fa-plus"></i> {{__('product.index.new')}}</a>
        @endif
        

       <!--Live Search Script AJAX-->
       
    </div>
    <script>
        $.ajaxSetup({ headers: {'csrftoken' : '@csrf' } });
    </script>
    <script>
            $(document).ready(function(){

                fetch_product_data();
                function fetch_product_data(query = '')
                {
                    
                    $.ajax({
                        url:"{{route('product.search')}}",
                        method:'GET',
                        data:{query:query},
                        dataType:'json',
                        success:function(data)
                            {
                                $('#productTable').html(data.table_data);
                                //$('#total_records').text(data.total_data);
                            }
                    });
                }

                $(document).on('keyup', '#search', function(){
                    var query = $(this).val();
                    fetch_product_data(query);
                });
            });
        </script>
        
@endsection