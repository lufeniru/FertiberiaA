<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title> @yield('titulo') </title>




        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      
    </head>

    <body>
        <!--parte realizada por Jaime-->
        @yield('cabecera')
        <?php
        $plantas = \Session::get('plantas');
        ?>
        <div class="container">
            <header>
                <div class="row">
                    <div id="estilocab" class="col-12">
                        <a href="index"><img src="imagenes/banner.png"></a>
                    </div>
                </div>
                <div class="row" id="menu">
                    <form action="compuestos" method="post">
                        {{ csrf_field() }}
                        <?php
                        foreach ($plantas as $p) {
                            echo '<input type="submit" class="btn btn-outline-success" value="' . $p->nombre . '"   name="menu">';
                        }
                        ?>

                    </form>
                </div>

            </header>


            <!-- poner en cuerpo si fuese necesario -->
            @yield('cuerpo')




            @yield('pie') 
            <footer>
                <div id="estilopie" class="col-lg-12">
                    <img src="imagenes/logo.png">
                    <p id="letrapie">© 2019 Copyright: <a href="mailto:daw2@cifpvirgendegracia.com">Daw 2 2019</a></p>               
                </div>
            </footer>

        </div>
    </body>
</html>
