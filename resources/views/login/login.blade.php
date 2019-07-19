<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logoV3.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">

    <title>Iniciar Sesion</title>
    <style>
    .p-left15{
        padding-left: 0;
        padding-right: 0;
    }
    .input-wout-focus:active{
        border-color: none;
    }
    .flex-center{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .input-group-text{
        background: rgba(255,255,255);
    }
    .btn-rounded{
        border-radius: 30px;
    }
    .bg-gradient-white{
        background: radial-gradient( ellipse, rgba(255,255,255), rgba(0,0,0,0.09) ) ;
    }
    .woutline:focus{
        outline:none;
        box-shadow: none;
    }
    </style>
  </head>
  <body class="flex flex-center bg-gradient-white">

    <div class="container-fluid">
        <div class="col-12 col-md-3 mx-auto">
            <form method="post" action="{{route('login')}}">
                @csrf
                <h1 class="display-4 text-danger text-center mb-3" style="font-size: 3rem!important;">Iniciar Sesión</h1>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                    <input type="login" id="login" name="login" class="form-control @error('login') is-invalid @enderror woutline" id="inlineFormInputGroup" value="{{old('login')}}" placeholder="UserName or Email" required autofocus>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-key"></i></div>
                    </div>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror woutline" id="inlineFormInputGroup" placeholder="Password" required autocomplete="current-password">
                </div>
                <div class="input-group mb-3">
                    {!! Recaptcha::render() !!}
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-danger pl-5 pr-5 btn-rounded" type="submit">   
                        Ingresar
                    </button>
                </div>
            </form>

        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>