<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inicio</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">

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
                            <legend><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWjghD4hNePzqXUpoZN4TLc6Ue5lRMWdlBpxGX_Zag6MsXRMBW" alt="logo de fertiberia"></legend>
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
