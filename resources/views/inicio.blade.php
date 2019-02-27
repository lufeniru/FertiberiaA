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
                border: thick solid #33cc00;
            }
            .row{
                margin-top: 50px;
            }
            .btn-outline-success{
                width: 200px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form name="formu" class=" offset-3 col-5" method="post" action="inicio">
                    {{ csrf_field() }}
                    <div id="inicio">
                        <fieldset>
                            <legend>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWjghD4hNePzqXUpoZN4TLc6Ue5lRMWdlBpxGX_Zag6MsXRMBW" alt="logo de fertiberia">
                            </legend>
                            <div id="inicio2">
                                <div>
                                    <input type="submit" class="btn btn-outline-success" name="boton" value="Administrador">
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-outline-success" name="boton" value="Laboratorio">
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-outline-success" name="boton" value="Ver analisis">
                                </div>

                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>
