<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title> @yield('titulo') </title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


        <link href="css/app.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <header>
                <div class="row">
                    <div id="estilocab" class="col-lg-12">
                        <img src="imagenes/banner.png">
                    </div>
                </div>
                <div class="row" id="menu">
                    <form action="admin" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            
                                <ul><input type="submit" class="btn btn-outline-success col-12" value="Añadir compuesto" name="menu2"></ul>
                                <ul><input type="submit" class="btn btn-outline-success col-12" value="Añadir elemento" name="menu2"></ul>
                                <ul><input type="submit" class="btn btn-outline-success col-12" value="Validar" name="menu2"></ul>
                                <ul><input type="submit" class="btn btn-outline-success col-12" value="Añadir planta" name="menu2"></ul>
                                <!--<ul><input type="submit" class="btn btn-outline-success col-12" value="Agregar un elemento a un compuesto" name="menu2"></ul>-->
                            
                        </div>
                    </form>
                </div>

            </header>
            <footer>
                <div id="estilopie" class="col-lg-12">
                    <img src="imagenes/logo.png">
                    <p id="letrapie">© 2019 Copyright: <a href="mailto:daw2@cifpvirgendegracia.com">Daw 2 2019</a></p>               
                </div>
            </footer>
        </div>


    </body>
</html>
