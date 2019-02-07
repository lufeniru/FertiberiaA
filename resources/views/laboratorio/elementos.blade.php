@extends('laboratorio/cabeceraLaboratorio')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');


$tanques[0]->tanque
?>
<a class="btn" href="lab"><span class="fa fa-arrow-left"></span>Volver</a>
<form action="introducir" method="post" class="col-12">
    {{ csrf_field() }}
    <input type="text" hidden value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    <?php
    echo 'Compuesto: ' . $compuesto[0]->compuesto . '<br>';
    ?><div class="row">
        <div class="col-12">
            <?php 
            date_default_timezone_set('Europe/Madrid');
            $fecha = Date('Y-m-d');
            $hora = Date('H:i');
            $valor = $fecha.'T'.$hora;
            
            ?>
            Fecha y hora: <input name="fechahora" value="<?php echo $valor ?>" type="datetime-local"> No programado: <input type="checkbox" name="prog">
        </div>
    </div>
    <div class="row" style="margin-top: 30px">
        <div class="col-12">
            <?php
            $i = 0;
            foreach ($elementos as $elem) {
                $segun = '';
                if ($elem->valor2 != null) {

                    $segun = $elem->valor1 . ' ' . $elem->condicion . ' ' . $elem->valor2 . ' ' . $elem->simbolo;
                } else {
                    $segun = $elem->condicion . ' ' . $elem->valor1 . ' ' . $elem->simbolo;
                }
                if ($i == 0) {
                    echo '<div class="row" style= "width:100%; margin-top:10px">';
                }
                ?> 
                <div class="col-lg-4 col-sm-12">
                    <table>
                        <tr><td style="width: 120px;">
                                <?php echo $elem->describe_elemento; ?></td>
                            <td style="width:80px;">
                                <input type="number" class="form-control" name="valor[]">
                            </td>
                            <td style="width: 120px;">
                                <?php echo $segun; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php
                if ($i == 2) {
                    echo '</div>';
                    $i = -1;
                }
                $i++;
            }
            if ($i % 3 != 0) {
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <?php if ($tanques[0]->tanque != 'Tanque1') { ?>
    <div class="row" style="margin-top: 20px">
            <div class="col-4">
                Muestra: <select name="tanque" class="custom-select">
                    <?php foreach ($tanques as $t) { ?>
                        <option value="<?php echo $t->tanque ?>"> <?php echo $t->tanque ?></option>
                    <?php } ?>
                </select>
            </div>
        </div><?php } else {
                    ?>
        <input type="text" value="Tanque1" hidden name="tanque">

    <?php } ?>

    <?php if ($compuesto[0]->granulometria != null) { ?>
        <div class="row" style="margin-top: 10px">
            <?php $granu = \Session::get('granu'); ?>
            <input type="text" value="' . $granu[0]->id_granu . '" hidden name="idgranu">
            <div class="col-12">
                <div style="text-align: center">Granulometria</div>
                <div class="row">
                    <?php foreach ($granu as $g) { ?>
                        <div class="col-4">
                            <?php echo $g->valor . '<br> <input type="number" class="form-control" name="granulometria[]" value=""><br>' . $g->condicion . ' ' . $g->valor1 . ' ' . $g->simbolo; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <input type="submit" class="btn btn-info" name="boton" value="Introducir">
</form>
@endsection



