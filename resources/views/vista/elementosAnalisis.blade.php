@extends('vista/cabeceraAnalisis')

@section('titulo')
Analisis
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');
$planta = 'PLANTA ' . \Session::get('planta');
$tanques[0]->tanque;
?>

<div class="container">

    <form action="elementosAnalisis" class="col-12" method="post">
        {{ csrf_field() }}

        <?php
        if (isset($ncomp)) {
            ?><input type="hidden" value="<?php echo $ncomp; ?>" name="ncomp" id="ncomp"> <?php
        }
        ?>
        <input type="hidden" value="<?php echo $elementos[0]->compuesto; ?>" name="comp" id="comp">

        Compuesto: <?php echo $compuesto[0]->compuesto; ?> <br>
        <div class="row">
            <?php
            if ($tanques[0]->tanque != 'Tanque1') {
                ?>
                <div class="col-4">
                    Tanque: <select name="tanque">
                        <?php foreach ($tanques as $t) { ?>
                            <option value="<?php echo $t->tanque; ?>"><?php echo $t->tanque; ?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
            } else {
                ?>
                <input type="text" value="Tanque1" hidden name="tanque" id="tanque">
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-12" style="padding:0; margin:0">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3" style="padding:0; margin:0">
                        <div class="col-12">
                            <div class="col-12" style="padding:0; margin:0">
                                <table>
                                    <tr><td><label for="fecha">Desde:</label></td>
                                        <td><input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>"></td></tr>

                            </div>
                            <div class="col-12" style="padding:0; margin:0">
                                <tr><td><label for="fechah">Hasta:</label></td>
                                    <td> <input type="date" name="fechah" id="fechah" value="<?php echo $fechah; ?>"></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" style="padding:0; margin:0">
                        <fieldset>
                            <ul>
                                <li class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="programado" id="programad" class="custom-control-input" value="1" <?php if($programado==1){echo "checked";}?>>
                                    <label for="programad" class="custom-control-label">Programado</label>
                                </li>
                                <li  class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="programado" id="noprogramado" class="custom-control-input"  value="0" <?php if($programado==0){echo "checked";}?>>
                                    <label for="noprogramado" class="custom-control-label">No programado</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="programado" id="programadoyno" class="custom-control-input" value="2" <?php if($programado!=1 && $programado!=0){echo "checked";}?>>
                                    <label class="custom-control-label" for="programadoyno">Programado y no programado</label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" style="padding:0; margin:0">
                        <fieldset>
                            <ul>
                                <li class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="validado" id="validado" class="custom-control-input" value="1" <?php if($validado==1){echo "checked";}?>>
                                    <label class="custom-control-label" onchange="filtro()" for="validado">Validado</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="validado" id="novalidado" class="custom-control-input" value="0" <?php if($validado==0){echo "checked";}?>>
                                    <label class="custom-control-label" for="novalidado">No validado</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">

                                    <input type="radio" name="validado" id="validadoyno" class="custom-control-input" value="2" <?php if($validado!=1 && $validado!=0){echo "checked";}?>>
                                    <label class="custom-control-label" for="validadoyno">Validado y no validado</label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2" style="padding:0; margin:0;">
                        <input type="submit" class="btn btn-info" style="width: 100px" name="boton" value="cargar">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive" style="padding:0; margin-top:20px">
                <table style="width:100%" class="table-striped table-success text-center">
                    <?php
                    if ($tabla != null && count($tabla) > 0) {
                        //dd($tabla,$tgranu);
                        $ch = true;
                        foreach ($tabla as $i => $fila) {
                            //Pintado de cabeceras.
                            if ($i == 0 || $ch) {
                                //Primera cabecera
                                ?><tr>
                                    <th rowspan="2">Fecha</th>
                                    <th rowspan="2">Programado</th>
                                    <th rowspan="2">Validado</th>
                                    <?php
                                    foreach ($fila as $elemento) {
                                        ?><th><?php echo $elemento->describe_elemento ?></th><?php
                                        }
                                        //Si hay granulometria se mete tambien.
                                        if ($tgranu != null && $tgranu > 0) {
                                            $filag = $tgranu[0];
                                            ?> <th colspan="<?php echo count($filag); ?>" style="text-align: center"> Granulometria</th> <?php
                                        }
                                        //Fin de la primera cabecera de granulometrias.
                                        ?> 
                                </tr>
                                <?php
                                //Fin de la primera cabecera.
                                //Segunda cabecera.
                                ?><tr><?php
                                    foreach ($fila as $elemento) {
                                        if ($elemento->valor2 == "" || $elemento->valor2 == null) {
                                            ?>
                                            <td> <?php echo $elemento->condicion, $elemento->valor1; ?><br> <?php echo $elemento->simbolo; ?></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $elemento->valor1, $elemento->condicion, $elemento->valor2; ?></td>
                                            <?php
                                        }
                                    }
                                    if ($tgranu != null && $tgranu > 0) {
                                        $filag = $tgranu[0];
                                        foreach ($filag as $elementog) {
                                            if ($elementog->valor2 == "" || $elementog->valor2 == null) {
                                                ?>
                                                <td><?php echo $elementog->condicion; ?> <?php echo $elementog->valor1; ?> <br> <?php echo $elementog->simbolo; ?></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td> <?php echo $elementog->valor1; ?> <?php echo $elementog->condicion; ?> <?php echo $elementog->valor2; ?></td>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tr>    
                                <?php
                                //Fin de la segunda cabecera.
                            }
                            //Pintado de datos.
                            ?>
                            <tr>    
                                <?php
                                foreach ($fila as $e => $elemento) {
                                    $prog="SI";
                                    $val="SI";
                                    if ($elemento->programado == '0') {
                                        $prog= 'NO';
                                    }
                                    if ($elemento->validado == '0') {
                                        $val = 'NO';
                                    }
                                    if ($e == 0) {
                                        ?><td> <?php echo $elemento->fechahora ?></td><?php ?><td> <?php echo $prog ?></td><?php ?><td> <?php echo $val ?></td><?php ?><td> <?php echo $elemento->lectura ?></td><?php
                                    } else {
                                        ?><td> <?php echo $elemento->lectura ?></td><?php
                                    }
                                }
                                if ($tgranu != null && $tgranu > 0) {
                                    $filag = $tgranu[$i];
                                    foreach ($filag as $elementog) {
                                        ?><td> <?php echo $elementog->lectura ?></td><?php
                                    }
                                }
                                ?>
                            </tr>    
                            <?php
                            //fin de pintado de datos
                            //Hay que mirar la siguiente linea, si cambia la granulometria, y si es distinta se pintan las cabeceras de nuevo.
                            if (($i + 1) < count($tabla)) {
                                $filasig = $tabla[$i + 1];
                                $ch2 = true;
                                $ch3 = true;
                                foreach ($fila as $u => $elemento) {
                                    $elementosig = $filasig[$u];
                                    if ($elemento->valor2 == $elementosig->valor2 && $elemento->simbolo == $elementosig->simbolo && $elemento->valor1 == $elementosig->valor1 && $elementosig->condicion == $elemento->condicion) {
                                        $ch2 = false;
                                    }
                                }
                                if ($tgranu != null && count($tgranu) > 0) {
                                    $gfila = $tgranu[$i];
                                    $sgfila = $tgranu[$i + 1];
                                    foreach ($gfila as $g => $gelemento) {
                                        $sgelemento = $sgfila[$g];
                                        if ($gelemento->valor2 == $sgelemento->valor2 && $gelemento->simbolo == $sgelemento->simbolo && $gelemento->valor1 == $sgelemento->valor1 && $gelemento->condicion == $sgelemento->condicion) {
                                            $ch3 = false;
                                        }
                                    }
                                } else {
                                    $ch3 = false;
                                }
                                //Si uno de las dos tablas a cambiado en su granulometria se cambia la cabecera
                                if ($ch2 || $ch3) {
                                    $ch = true;
                                } else {
                                    $ch = false;
                                }
                            }
                            //Fin de las comprobaciones de cambios de cabecera
                        }
                    } else {
                        ?> <tr><td>Sin resultados.</td></tr> <?php
                    }
                    ?>
                </table>
            </div>
        </div>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $("#fecha" ).change(function () {
        
        var fd = $("#fecha").val();
        frac=fd.toString().split("-");
        fd = new Date(frac[0],frac[1],frac[2]);
        var fh = $("#fechah").val();
        frac=fh.toString().split("-");
        fh = new Date(frac[0],frac[1],frac[2]);

        if(fd > fh)
        {
            $("#fecha").val($("#fechah").val()) ;
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'La fecha "desde" no puede ser superior a la fecha "hasta"!',
                showConfirmButton:false,
                timer:2000
              });
        }
  })
  .change();
  
  $("#fechah" ).change(function () {
        
        var fd = $("#fecha").val();
        frac=fd.toString().split("-");
        fd = new Date(frac[0],frac[1],frac[2]);
        var fh = $("#fechah").val();
        frac=fh.toString().split("-");
        fh = new Date(frac[0],frac[1],frac[2]);

        if(fh < fd)
        {
            $("#fechah").val($("#fecha").val()) ;
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'La fecha "hasta" no puede ser inferior a la fecha "desde"!',
                showConfirmButton:false,
                timer:2000
              });
        }
  })
  .change();
</script>
@endsection