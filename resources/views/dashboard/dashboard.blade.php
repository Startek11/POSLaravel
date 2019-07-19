@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="display-4">{{__('dashboard.welcome')}} {{Auth::user()->names}}</h2>
            <p>{{__('dashboard.manual')}} <a href="{{asset('pdfs/user_manual.pdf')}}" target="_blank">{{__('dashboard.clickhere')}}</a></p>
            <p>{{__('dashboard.navigate')}}</p>
            
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>{{__('dashboard.saleroom')}}</h3>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-success rounded" id="tablesCard">
                            <a class="btn btn-block text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('salesroom.index')}}">
                            <i class="fas fa-utensils"></i> {{__('dashboard.tables')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-warning rounded" id="saleCard">
                            <a class="btn btn-block h2 text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('report.index')}}">
                            <i class="fas fa-share-square"></i> {{__('dashboard.fastSale')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>{{__('dashboard.store')}}</h3>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-primary rounded" id="productsCard">
                            <a class="btn btn-block h2 text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('product.index')}}">
                            <i class="fab fa-product-hunt"></i> {{__('dashboard.products')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-danger rounded" id="suppliesCard">
                            <a class="btn btn-block h2 text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('supply.index')}}">
                            <i class="fas fa-box-open"></i> {{__('dashboard.supplies')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body bg-warning p-0 rounded" id="suppliesCard">
                            <a class="btn btn-block text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('provider.index')}}">
                            <i class="fas fa-truck"></i> {{__('dashboard.providers')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>{{__('dashboard.admin')}}</h3>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-success rounded" id="clientsCard">
                            <a class="btn btn-block h2 text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('client.index')}}">
                            <i class="fas fa-crown"></i> {{__('dashboard.clients')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card p-0">
                        <div class="card-body p-0 bg-warning rounded" id="usersCard">
                            <a class="btn btn-block h2 text-center text-white bg-transparent px-1 py-4" style="font-size: 1.7rem;" href="{{route('user.index')}}">
                            <i class="fas fa-users"></i> {{__('dashboard.users')}}
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection