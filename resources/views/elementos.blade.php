@extends('cabeceraLaboratorio')

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
<form action="introducir" method="post">
    {{ csrf_field() }}
    <input type="text" hidden value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    <?php
    echo 'Compuesto: ' . $compuesto[0]->compuesto . '<br>';
    ?><div class="row">
        Fecha y hora: <input name="fechahora" type="datetime-local">
    </div>
    <div class="row"><?php
        $i = 0;
        foreach ($elementos as $elem) {
            $segun = '';
            if ($elem->valor2 != null) {
                
                $segun = $elem->valor1 . ' ' . $elem->condicion . ' ' . $elem->valor2 . ' ' . $elem->simbolo;
            }else{
                $segun = $elem->condicion . ' ' . $elem->valor1.' '. $elem->simbolo;
            }
            if ($i == 0) {
                echo '<div class="row" style= "width:100%">';
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
        if ($i%3 !=0) {
            echo '</div>';
        }
        ?>
    </div>
    <div class="row">
        <?php if ($tanques[0]->tanque != 'Tanque1') { ?>
            <div class="col-4">
                Muestra: <select name="tanque" class="custom-select">
                    <?php foreach ($tanques as $t) { ?>
                        <option value="<?php echo $t->tanque ?>"> <?php echo $t->tanque ?></option>
                    <?php } ?>
                </select>
            </div><?php } else {
                    ?>
            <input type="text" value="Tanque1" hidden name="tanque">
        <?php } ?>
    </div>
    <?php if ($compuesto[0]->granulometria != null) { ?>
        <div class="row">
            <?php $granu = \Session::get('granu'); ?>
            <input type="text" value="' . $granu[0]->id_granu . '" hidden name="idgranu">
            <fieldset class="col-12">
                <legend>Granulometria</legend>
                <div class="row">
                    <?php foreach ($granu as $g) { ?>
                        <div class="col-4">
                            <?php echo $g->valor . '<br> <input type="number" class="form-control" name="granulometria[]" value=""><br>' . $g->condicion . ' ' . $g->valor1 . ' ' . $g->simbolo; ?>
                        </div>
                    <?php } ?>
                </div>
            </fieldset>
        </div>
    <?php }
    ?>
    <input type="submit" class="btn btn-info" name="boton" value="Introducir">
</form>
@endsection



