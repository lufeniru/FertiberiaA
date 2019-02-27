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
                        <a href="index"><img src="imagenes/banner.png"></a>
                    </div>
                </div>

            </header>
            <div class="row">
                <div class="offset-lg-4 col-4" style="margin-top: 30px; text-align: center; border: thin solid green">
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
        <div>
            <form action="exportarExcel" name="export" method="POST">
                {{ csrf_field() }}
                <input type="submit" name="bt" value="Exportar">
            </form>
        </div>
    </body>
</html>



