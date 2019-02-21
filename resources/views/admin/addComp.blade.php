@extends('admin/admin')

@section('titulo')
Añadir Compuesto
@endsection

@section('cuerpo')
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb" class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item"><a href="admin">Administrador</a></li>
                <li class="breadcrumb-item active"aria-current="page">Añadir compuesto</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container" style="text-align: center">
    <form action="addComp" name="addComponente" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="alert alert-danger col-12" role="alert">
                Advertencia: se está modificando la estructura de la aplicación, podría causar fallos inesperados, no contemplados en el desarrollo de la aplicación
            </div>
            <div class="col-6"><h4>Planta:</h4> 
                <select name="planta" class="custom-select" id="planta">
                    <?php
                    foreach ($plantas as $p) {
                        echo '<option value="' . $p->id_planta . '">' . $p->nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-6"><h4>Nombre completo del compuesto:</h4> <input type="text" class="form-control" name="nombreComp" required=""></div>
        </div>
        <div class="row">
            <div class="col-6"> <h4>Identificador del compuesto:</h4> <input type="text" class="form-control" name="idComp" placeholder="(ej: Urea -> U-18)" required=""></div>
            <div class="col-6 form-check">
                <h4 style="margin-top: 30px">
                    <label class="form-check-label" for="granu">Granulometría</label>
                    <input type="checkbox" class="custom-checkbox" name="granulometria" id="granu">
                </h4>
                <div id="numero"></div>
            </div>
        </div>
        <div id="granulometrias" class="row" style="margin-top: 20px"></div>
        <div class="row">
            <div class="col-12">
                <input type="submit" class="btn btn-info" name="btAddElemento" value="Aceptar">
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#granu').change(function () {

            if ($('#granu').prop('checked')==true ) {
                var input = '¿Nº de granulometrias? <input class="form-control" type="number" name="cuantos" id="cuantos" onchange="granus()" min="1">';
                $('#numero').html(input);
            } else {
                $('#numero').html("");
                $("#granulometrias").html("");
            }
        });
    });

    function granus() {
        var a = $('#cuantos').val();
        var cajas = '';

        for (var i = 0; i < a; i++) {
            var j = i + 1;
            var caja = '<div class="col-6"><h4>Granulometría ' + j + '</h4>' + '<h5>Especificación:</h5> <input class="form-control" type="text" name="valor[]" placeholder="Ej: 1mm">' + '<br>' + '<h5>Condición:</h5> <input class="form-control" type="text" name="condicion[]" placeholder="Ej: > ">' + '<br>' + '<h5>Valor:</h5> <input class="form-control" type="number" name="valor1[]" placeholder="Ej: 1">' + '<br>' + '<h5>Símbolo:</h5> <input class="form-control" type="text" name="simbolo[]" placeholder="Ej: %">' + '</div>';
            cajas = cajas + caja;
        }
        $('#granulometrias').html(cajas);
    }
</script>

@endsection



