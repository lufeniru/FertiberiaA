@extends('vista/cabeceraAnalisis')

@section('titulo')
Analisis
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');

$tanques[0]->tanque;
        
?>
<form action="elementosAnalisis" method="post">
    {{ csrf_field() }}
    
    <?php 
    if(isset($ncomp))
    {
        ?><input type="hidden" value="<?php echo $ncomp; ?>" name="ncomp"> <?php
    }
    ?>
    <input type="hidden" value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    
    Compuesto: <?php echo $compuesto[0]->compuesto; ?> <br>
    <div class="row">
        <?php
        if ($tanques[0]->tanque != 'Tanque1') 
        {?>
            <div class="col-4">
            Tanque: <select name="tanque">
            <?php foreach ($tanques as $t) {?>
                <option value="<?php echo $t->tanque; ?>"><?php echo $t->tanque; ?> </option>
            <?php
            }
            ?>
            </select>
            </div>
            <?php
        } 
        else 
        { ?>
            <input type="text" value="Tanque1" hidden name="tanque">
            <?php
        }
            ?>
        <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
        <input type="submit" class="btn btn-info" name="boton" value="cargar">
    </div>
    <div class="row">
        <div class=col-10 style="padding:0; margin:0">
            <?php
            if(count($tabla)>0)
            {
                //Iniciando la tabla--------------------------------------------------------
                //Cabecera 1--------------------------------------------------------------
                ?>
                
                <table style="width:100%" class="table-striped">
                    <tr>
                        <td rowspan="2">Fecha</td>
                        <td rowspan="2">Programado</td>
                        <td rowspan="2">Validado</td>
                <?php
                for($i=0; $i<$nelementos;$i++)
                {
                    $fila=$tabla[$i];
                      ?>
                    <td> <?php echo $fila->describe_elemento;?></td>
                    <?php
                }
                    ?>
                </tr>
                <?php
                //Fin cabecera 1----------------------------------------------------------
                //Cabecera 2--------------------------------------------------------------
                ?>
                <tr>
                <?php
                for($i=0; $i<$nelementos;$i++)
                {
                    $fila=$tabla[$i];
                    if($fila->valor2==""||$fila->valor2==null)
                    {
                        ?>
                        <td> <?php echo $fila->condicion, $fila->valor1; ?><br> <?php echo $fila->simbolo;?></td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td><?php echo $fila->valor1, $fila->condicion, $fila->valor2; ?></td>
                        <?php
                    }
                }
                ?>
                </tr>
                <?php
                //Fin cabecera 2----------------------------------------------------------
                //Datos ------------------------------------------------------------------
                ?>
                <tr>
                <?php
                $prog = 'si';
                if ($tabla[0]->programado === 0) {
                    $prog = 'no';
                }
                $val = 'no';
                if ($tabla[0]->validado === 1) {
                    $val = 'si';
                }
                ?>
                <td> <?php $tabla[0]->fechahora; ?></td><td><?php echo $prog;?> </td><td><?php echo $val; ?></td>
                <?php
                foreach ($tabla as $i=>$fila)
                {
                    if($i>0)
                    {
                        if(($i)%$nelementos==0)
                        {
                             $prog = 'si';
                            if ($fila->programado === 0) {
                                $prog = 'no';
                            }
                             $val = 'no';
                            if ($tabla[0]->validado === 1) {
                                $val = 'si';
                            }
                                        ?></tr><tr><td><?php echo $fila->fechahora; ?></td><td><?php $prog;?> </td><td> <?php $val; ?> </td>
                                <?php
                        }
                    }?>
                    <td><?php echo $fila->lectura; ?></td>
                    <?php
                }?>
                </tr>
                <?php
                //Fin Datos---------------------------------------------------------------
                ?>
                </table>
                <?php
                //Fin de la tabla-----------------------------------------------------------

            }
            else
            {
                ?>'Sin analisis'
                <?php
            }?>
            </div>
            <div class=col-2 style="padding:0">
            <?php
            if(count($tgranu)>0)
            {
                //Iniciando la tabla--------------------------------------------------------
                //Cabecera 1----------------------------------------------------------------
                ?>
                <table style="width: 100%; height:95%" class="table-striped"><tr>
                        <td colspan="<?php echo $ngranulometria; ?>" style="text-align: center">Granulometria</td>
                    </tr>
                    <?php
                    //Fin cabecera 1----------------------------------------------------------
                    //Cabecera 2--------------------------------------------------------------
                    ?>
                    <tr>
                    <?php
                    for($i=0; $i<$ngranulometria;$i++)
                    {
                        $fila=$tgranu[$i];
                        if($fila->valor2==""||$fila->valor2==null)
                        {
                            ?>
                            <td><?php echo $fila->condicion; ?> <?php echo $fila->valor1; ?> <br> <?php echo $fila->simbolo; ?></td>
                            <?php
                        }
                        else
                        {
                            ?>
                            <td> <?php echo $fila->valor1; ?> <?php echo $fila->condicion; ?> <?php echo $fila->valor2; ?></td>
                            <?php
                        }
                    }
                    ?>
                    </tr>
                    <?php
                    //Fin cabecera 2----------------------------------------------------------
                    //Datos ------------------------------------------------------------------
                    ?>
                    <tr>
                    <?php
                    foreach ($tgranu as $i=>$fila)
                    {
                        if($i>0)
                        {
                            if(($i)%$ngranulometria==0)
                            {
                                ?>
                                </tr><tr>
                                <?php
                            }
                        }
                        ?>
                        <td><?php echo $fila->lectura; ?></td>
                        <?php
                    }
                    ?>
                    </tr>
                    <?php
                    //Fin Datos---------------------------------------------------------------
                    ?>
                </table>
                <?php
                //Fin de la tabla-----------------------------------------------------------
                ?>
                </div>
                <?php
            }
            ?>
    </div>
</form>
@endsection