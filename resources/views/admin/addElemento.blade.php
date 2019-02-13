@extends('admin/admin')

@section('titulo')
Añadir Elemento
@endsection

@section('cuerpo')

<div class="container" style="text-align: center">
    <form action="addElemento" name="addElemento" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12"><h4>Advertencia: se está modificando la estructura de la aplicación, podría causar fallos inesperados, no contemplados en el desarrollo de la aplicación</h4></div>

            <div class="col-6"><h4>Planta:</h4> <select name="planta" class="custom-select" id="planta">
                    <?php
                    foreach ($plantas as $p) {
                        echo '<option value="' . $p->id_planta . '">' . $p->nombre . '</option>';
                    }
                    ?>
                </select></div>
            <div id="comp" class="col-6">
                <?php echo $comp; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6"><h4>Nombre completo del elemento:</h4> <input type="text" class="form-control" name="nombreElemento"></div>
            <div class="col-6"> <h4>Identificador del elemento:</h4> <input type="text" class="form-control" name="idElem" placeholder="(ej: Nitrato Total -> NiTot)"></div>
            <div class="col-12"> 
                <div class="row">
                    <div class="col-6"> <h4>Condición:</h4>
                        <select name="condicion" id="condicion" class="custom-select">
                            <option selected value="null">Sin condición</option>
                            <option value=">"> Mayor que '>'</option>
                            <option value="<"> Menor que '<'</option>
                            <option value="<>"> Entre '< >'</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <h4>Valor/es de la condición:</h4>
                        <input type="number" class="form-control" name="valor1" id="val1" disabled placeholder="Valor 1">
                        <input type="number" hidden class="form-control" id="val2" name="valor2" placeholder="Valor 2">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4>¿En qué unidad se mide este elemento?</h4>
                <input type="text" class="form-control" name="simbolo">
            </div>
            <div class="col-6">
                <input type="submit" class="btn btn-info" name="btAddElemento" value="Aceptar">
            </div>
        </div>
    </form>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#planta').change(function () {
        //we will send data and recive data fom our AjaxController
        $.ajax({
            url: 'sacarcomp',
            data: {'planta': $("#planta").val()},
            type: 'post',
            success: function (response) {
                $("#comp").html(response);
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                //nos dara el error si es que hay alguno
                window.open(JSON.stringify(x));
                alert('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
            }
        });
    });
    $("#condicion").change(function () {
        if ($("#condicion").val() !== 'null') {
            if ($("#condicion").val() === '<>') {
                $("#val2").removeAttr('hidden');
                $("#val1").removeAttr('disabled');
            } else {
                $("#val2").attr('hidden', 'true');
                $("#val1").removeAttr('disabled');
            }
        } else {
            $("#val2").attr('hidden', 'true');
            $("#val1").attr('disabled', 'true');
        }
    });
</script>


@endsection



