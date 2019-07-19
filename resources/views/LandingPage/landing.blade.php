<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logoV3.png">
    <title>Cafe Valenzuela AQP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-image: url("https://i.ibb.co/jLZ3Gmb/art-blur-cappuccino-302899.jpg");
            background-repeat: no-repeat;
            background-attachment:fixed;
            background-size: cover;
            background-position: center;
        }
        #difuminate-background{
            width: 100%;
            height: 100vh;
            background-color: rgba(145,56,16,0.3);
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
        }
        #logValenzuela{
            width: 311px;
            height: 97px;
        }
        #content-center{
            display: flex;
            flex-direction: column;
        }
        .button-ingresar{
            margin-top: 10px;
            width: 155px;
            height: 35px;
            background-color: rgba(255,187,109,0.45);
            border-radius: 34px;
            border: 2px solid rgba(180,15,23);
            color: rgba(180,15,23);
            align-self: center;
            transition: 0.5s;
        }
        .text-red{
            color: rgba(180,15,23);
            
        }
        .text-red:hover{
            text-decoration: none;
            color: rgba(180,15,23);
        }
        .button-ingresar:hover{
            cursor: pointer;
            background-color: rgba(255,187,109,0.70);
        }
        .button-ingresar:focus{
            outline: none;
        }
        @media only screen and (min-width: 1024px) {
           #logValenzuela{
            width: 597px;
            height: 186px;
           }
           .button-ingresar{
               width: 194px;
               height: 45px;
               font-size: 22px;
           }
        }
    </style>
</head>
<body>
    <div id="difuminate-background">
        <div id="content-center">
            <img src="https://i.ibb.co/tQrrM3H/logo-Valenzuela.png" alt="Cafe Valenzuela Logo" id="logValenzuela">
            <a class="button-ingresar text-center text-red" href="{{route('login')}}">Iniciar</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>