<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--parte realizada por Jaime-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('titulo') </title>



        <!-- Fonts -->


        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>

       
    </head>

    <body>
        @yield('cabecera')
        <?php
        $existe = \Session::get('planta');
        $plantas = \Session::get('plantas');
        ?>
        <div class="container">
            <header>
                <div class="row">
                    <div id="estilocab">
                        <a href="index"><img src="imagenes/banner.png"></a>
                    </div>
                </div>
                <!--parte realizada por Sergio-->
                <div  class="menu">
                    <form action="vercompuestos" class="row" method="post">
                        {{ csrf_field() }}
                        <?php
                        foreach ($plantas as $p) {
                            echo '<input type="submit" class="btn btn-outline-success col-lg-3 col-md-4 col-sm-12" value="' . $p->nombre . '"   name="menu">';
                        }
                        ?>
                    </form>
                </div>
                <!--fin parte realizada por Sergio-->
            </header>


            <!-- poner en cuerpo si fuese necesario -->
            @yield('cuerpo')




            @yield('pie') 
            <footer class="row" style="width:100%">
                <div id="estilopie" class="col-lg-12">
                    <img src="imagenes/logo.png">
                    <p id="letrapie">© 2019 Copyright: <a href="mailto:daw2@cifpvirgendegracia.com">Daw 2 2019</a></p>               
                </div>
            </footer>
        </div>


    </body>
</html>
