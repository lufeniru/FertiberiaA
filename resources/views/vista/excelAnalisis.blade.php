<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');
$planta = 'PLANTA ' . \Session::get('planta');
$tanques[0]->tanque;
?>
<!--parte realizada por Sergio-->
<?php
date_default_timezone_set('Europe/Madrid');
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$compuesto[0]->compuesto.'-'.date("d-m-Y").'.xls');
?>
<div class="container">
        <div class="row">
            <div class="col-12 table-responsive" style="padding:0; margin-top:20px">
                <table style="width:100%; background-color: lightgreen;" class="table-striped table-success" >
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
</div>