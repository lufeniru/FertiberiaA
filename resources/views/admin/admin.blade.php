<!doctype html>
<!--parte realizada por Jaime-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('titulo') </title>



        <!-- Fonts -->


        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">


        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>
    </head>

    <body>

        @yield('cabecera')
        <div class="container">
            <header>
                <div class="row">
                    <div id="estilocab">
                        <a href="index"><img src="imagenes/banner.png"></a>
                    </div>
                </div>
                <div  class="menu">
                    <form action="admin" class="row" method="post">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-outline-success col-lg-3 col-md-6 col-sm-12" value="Añadir planta" name="menu2">
                        <input type="submit" class="btn btn-outline-success col-lg-3 col-md-6 col-sm-12" value="Añadir compuesto" name="menu2">
                        <input type="submit" class="btn btn-outline-success col-lg-3 col-md-6 col-sm-12" value="Añadir elemento" name="menu2">
                        <input type="submit" class="btn btn-outline-success col-lg-3 col-md-6 col-sm-12" value="Validar" name="menu2">
                    </form>
                </div>

            </header>
            @yield('cuerpo')
           


            @yield('pie') 
            <footer class="row">
                <div id="estilopie" class="col-lg-12">
                    <img src="imagenes/logo.png">
                    <p id="letrapie">© 2019 Copyright: <a href="mailto:daw2@cifpvirgendegracia.com">Daw 2 2019</a></p>               
                </div>
            </footer>

        </div>
    </body>
</html>
