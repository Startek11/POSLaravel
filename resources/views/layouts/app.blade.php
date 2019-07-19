<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/logoV3.png')}}">
    <title>Cafe Valenzuela G2</title>
    <!--Boostrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    
    
</head>
<style>
    /** To solve Problem With DropdownMenu*/
    .navbar .dropdown-menu-right { 
        right: 0; 
        left: auto; 
    }
</style>
<body style="background-color: rgba(0,0,0,0.1);">
    <div class="navbar fixed-top border-bottom bg-white" id="navbarMain">

        <div class="d-flex align-center">
            <button class="btn btn-lig bg-white text-dark mr-xs-0 mr-md-2" id="menu-toggle"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand " href="{{route('dashboard')}}">
                 <img src="{{asset('img/layouts/app/nav-logo6.png')}}" width="226" height="30" class="d-inline-block align-top img-fluid" alt="">   
            </a>
        </div>
        
        <div id="user-session" class="d-flex align-center">
            <!--<div class="ml-2 dropdown d-none d-md-inline-block">
                <button class="dropdown-toggle btn bg-transparent" id="dropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('img/lang/'.App::getLocale().'.jpg')}}" alt="Lang Flag" class="rounded-circle" width="24px" height="24px">
                    {{__('layouts.app.'.App::getLocale())}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownLang">
                <h6 class="dropdown-header">{{__('layouts.app.language')}}</h6>
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{route('app.lang',$lang)}}">
                                <img src="{{asset('img/lang/'.$lang.'.jpg')}}" alt="{{$language}} Flag" class="rounded-circle" width="24px" height="24px"> {{__('layouts.app.'.$lang)}}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>-->
            <div class="dropdown d-flex align-center">
                <button class="btn dropdown-toggle bg-transparent p-0 pl-md-1" type="button" id="dropdownButtonUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="d-none d-md-inline-block mb-0 mx-1">{{Auth::user()->names}}</p>
                    <img src="{{asset('storage/'.Auth::user()->file)}}" alt="User Photo" class="rounded-circle" width="24px" height="24px">
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownButtonUser">
                    <!--<a class="dropdown-item" href="#"><i class="fas fa-id-badge text-success"></i> {{__('layouts.app.profile')}}</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-map-marker text-primary"></i> {{__('layouts.app.points')}}</a>-->
                    
                    <a class="dropdown-item bg-danger text-white" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fas fa-door-open"></i> {{__('layouts.app.logout')}}</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-center d-flex d-md-none">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a class="mx-1" href="{{route('app.lang',$lang)}}">
                                    <img src="{{asset('img/lang/'.$lang.'.jpg')}}" alt="{{$language}} Flag" class="rounded-circle" width="24px" height="24px">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
             <div class="ml-2 dropdown d-none d-md-inline-block">
                <button class="dropdown-toggle btn bg-transparent" id="dropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('img/lang/'.App::getLocale().'.jpg')}}" alt="Lang Flag" class="rounded-circle" width="24px" height="24px">
                    {{__('layouts.app.'.App::getLocale())}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownLang">
                <h6 class="dropdown-header">{{__('layouts.app.language')}}</h6>
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{route('app.lang',$lang)}}">
                                <img src="{{asset('img/lang/'.$lang.'.jpg')}}" alt="{{$language}} Flag" class="rounded-circle" width="24px" height="24px"> {{__('layouts.app.'.$lang)}}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper -->
    <div id="wrapper" class="d-flex" style="padding-top: 50px;">
        <div class="bg-dark border-right text-white" id="sidebar-wrapper">
            <div class="sidebar-heading font-weight-bold h3 text-success"> {{__('layouts.app.sidebarTitle')}}</div>
            <div class="list-group list-group-flush">
                <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-house-damage" class="text-primary" width="20px"></i> {{__('layouts.app.dashboard')}}
                </a>
                <a href="{{route('salesroom.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-utensils" class="text-info" width="20px"></i>  {{__('layouts.app.salesroom')}}
                </a>
                <a href="{{route('product.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-money-check-alt" class="text-danger" width="20px"></i> {{__('layouts.app.products')}}
                </a>
                <a href="{{route('supply.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-box" class="text-primary" width="20px"></i>  {{__('layouts.app.supplies')}}
                </a>
                <a href="{{route('client.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-address-book" class="text-success" width="20px"></i>  {{__('layouts.app.customers')}}
                </a>
                <a href="{{route('provider.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-truck" class="text-warning" width="20px"></i>  {{__('layouts.app.providers')}}
                </a>
                <a href="{{route('report.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-image" class="text-primary" width="20px"></i>  {{__('layouts.app.reports')}}
                </a>
                <a href="{{route('user.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-users" class="text-info" width="20px"></i> {{__('layouts.app.users')}}
                </a>
            </div>
        </div>
        <div id="page-content-wrapper" class="pt-4">
            @yield('content')
        </div>
    </div>
    
    <!--Bootstrap Java Script-->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--JS propio-->
    <script>
        //para que funcione el boton
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        //para arreglar el navbar

    </script>
    <script>
    //SEARCH SELECT FUNCTION
        $(document).ready(function() {
            $('.searchSelect').select2({
                placeholder: "{{__('supply.select')}}",
                theme: "bootstrap"
            });
        });
    </script>
</body>
</html>