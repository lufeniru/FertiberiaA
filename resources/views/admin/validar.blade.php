@extends('admin/admin')

@section('titulo')
Validaciones
@endsection

@section('cuerpo')
<!--parte realizada por Jaime-->
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb" class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item"><a href="admin">Administrador</a></li>
                <li class="breadcrumb-item active"aria-current="page">Validar datos</li>
            </ol>
        </nav>
    </div>
</div> 

<div class="container">
    <div class="row">
        <div class="col-7">

            <h5>Plantas:</h5>
            <?php
            $i = 0;
            foreach ($plantas as $p) {
                ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="planta<?php echo $i; ?>" name="planta" value="<?php echo $p->id_planta; ?>" onchange="filtro()" class="custom-control-input">
                    <label class="custom-control-label" for="planta<?php echo $i; ?>"><?php echo $p->nombre ?></label>
                </div>

                <?php
                $i++;
            }
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="planta" name="planta" checked value="0" onchange="filtro()" class="custom-control-input">
                <label class="custom-control-label" for="planta">Todas</label>
            </div>
        </div>
        <div class="col-5">

            <h5>Programado:</h5>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="progsi" name="prog" value="si" onchange="filtro()" class="custom-control-input">
                <label class="custom-control-label" for="progsi">si</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="progno" name="prog" value="no" onchange="filtro()" class="custom-control-input">
                <label class="custom-control-label" for="progno">no</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="progtod" name="prog" checked onchange="filtro()" value="todos" class="custom-control-input">
                <label class="custom-control-label" for="progtod">Todas</label>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px" id="select">
        <select class="col-12 custom-select" name="registro" id="registro" size="5">
            <?php
            foreach ($analisis as $a) {
                $pro = 'no';
                if ($a->programado == 1) {
                    $pro = 'si';
                }
                ?>

                <option value="<?php echo $a->fechahora . ',' . $a->id_compuesto . ',' . $a->nombre ?>"><?php echo 'Fecha: ' . $a->fechahora . ', Planta: ' . $a->nombre . ', Compuesto: ' . $a->compuesto . ', Programado: ' . $pro ?></option>

                <?php
            }
            ?>
        </select>
    </div>
    <div id="resultado">

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#registro').change(function () {
        //we will send data and recive data fom our AjaxController
        $.ajax({
            url: 'analisis',
            data: {'registro': $("#registro").val()},
            type: 'post',
            success: function (response) {
                $("#resultado").html(response);
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            
           
        });
    });
    function filtro() {
        var a = document.getElementsByName('planta');
        var b = document.getElementsByName('prog');
        var planta;
        var prog;
        for (var x in a) {
            if (a[x].checked) {
                planta = a[x].value;
            }
        }
        for (var y in b) {
            if (b[y].checked) {
                prog = b[y].value;
            }
        }
        //we will send data and recive data fom our AjaxController
        $.ajax({
            url: 'filtro',
            data: {'planta': planta, 'prog': prog},
            type: 'post',
            success: function (response) {
                $("#registro").html(response);
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
    }

    function alerta() {
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: "Validacion",
            showConfirmButton: false,
            timer: 1500
        });
    }
</script>
@endsection



