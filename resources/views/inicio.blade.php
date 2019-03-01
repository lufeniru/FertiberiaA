<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inicio</title>

        <!-- Fonts -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/estiloEstructuraCabPie.css') !!}"/>
        <!-- Styles -->
 
        <style>
            #inicio div {
                padding: 30px;
                text-align: center;

            }
            #inicio2{
                box-shadow: 0px 0px 5px 5px #4C9B01;
                border: thin solid #000000;
                border-radius: 10px;
                margin-top: 20px;
            }
            
            .btn-info{
                width: 200px;
            }
        </style>
    </head>
    <body>
        <!--parte realizada por Jaime-->
        <div class="container">
            <div class="row">
                <form name="formu" class="col-12" method="post" action="inicio">
                    {{ csrf_field() }}
                    <div id="inicio" class="row">
                        <fieldset class="col-12">
                            <div class="row">
                                <legend class="col-12">
                                <img  src="imagenes/Fertiberia.png" alt="logo de fertiberia">
                            </legend>
                                <div id="inicio2" class="col-12">
                                    <div class="row">
                                    <input type="submit" class="btn btn-info col-lg-4 col-md-4 col-sm-12 mt-5" name="boton" value="Administrador">
                                    <input type="submit" class="btn btn-info col-lg-4 col-md-4 col-sm-12 mt-5" name="boton" value="Laboratorio">
                                    <input type="submit" class="btn btn-info col-lg-4 col-md-4 col-sm-12 mt-5" name="boton" value="Ver analisis">
                                    </div>
                            </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>
