<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title> @yield('titulo') </title>



        <!-- Fonts -->


        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>
        <!-- Styles -->
       
    </head>

    <body>
        <!--parte realizada por Joaquin-->
        <div class="container">
            <header>

                <div class="row">
                    <div id="estilocab" class="col-lg-12">
                        <a href="index"><img src="imagenes/banner.png"></a>
                    </div>
                </div>

            </header>
            <div class="row">
                <div class="offset-lg-4 col-lg-4 col-sm-12" style="margin-top: 30px; text-align: center; border: thin solid green">
                    <div id="header"> <h2>Login</h2></div>
                    <form action="login" name="login" method="post" style="text-align: center">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Usuario</label>
                            <input type="text" class="form-control" name="user" id="exampleFormControlInput1" placeholder="Nombre de usuario">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Contraseña</label>
                            <input type="password" class="form-control" name="pass" id="exampleFormControlInput1" placeholder="******">
                        </div>
                        <input type="submit" class="btn btn-success" name="btLogin" value="Aceptar">
                    </form>
                </div>
            </div>
        </div>
       
    </body>
</html>



