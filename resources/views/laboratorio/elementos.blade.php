@extends('laboratorio/cabeceraLaboratorio')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');


?>
<!--parte realizada por Jaime-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
        function alerta() {
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Registro completo",
                showConfirmButton: false,
                timer: 1500
            });
        }
        function nohay(){
            Swal.fire({
                position: 'center',
                type: 'error',
                title: "No Existen elementos para este compuesto",
                showConfirmButton: false,
                footer: '<a href="javascript:window.history.back();">Volver</a>'
            });
        }
       
        
</script>
    <div class="row">
        <a class="btn col-1" href="javascript:window.history.back();"><span class="fa fa-arrow-left"></span>Volver</a>
    </div>
    <div class="row">
        <?php if (isset($elementos[0])) {
            
        ?>
        <form action="introducir" method="post" onsubmit="alerta()" class="col-12">
            {{ csrf_field() }}
            <input type="text" hidden value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
            <?php
            echo '<div class="row" style="margin-top: 30px">';
            echo '<div class="col-12"> Compuesto: ' . $compuesto[0]->compuesto . '</div>';
            echo '</div>';
            ?><div class="row" style="margin-top: 30px">
                <div class="col-12">
                    <div class="row">
                        <?php
                        date_default_timezone_set('Europe/Madrid');
                        $fecha = Date('Y-m-d');
                        $hora = Date('H:i');
                        $valor = $fecha . 'T' . $hora;
                        ?>
                        <div class="col-3">Fecha y hora: <input name="fechahora" max="<?php echo $valor?>" class="form-control" value="<?php echo $valor ?>" type="datetime-local"></div><div class="col-3 custom-control custom-checkbox ">  <input type="checkbox" class="custom-control-input" id="prog" name="prog"><label class="custom-control-label" for="prog">No programado</label></div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 30px">
                <div class="col-12">
                    <div style="text-align: center"><h3>Elementos</h3></div>
                    <div class="row" style= "width:100%; margin-top:10px">
                    <?php
                    $i = 0;
                    $j = 0;
                    foreach ($elementos as $elem) {

                        $segun = '';
                        if ($elem->valor2 != null) {

                            $segun = $elem->valor1 . ' ' . $elem->condicion . ' ' . $elem->valor2 . ' ' . $elem->simbolo;
                        } else {
                            $segun = $elem->condicion . ' ' . $elem->valor1 . ' ' . $elem->simbolo;
                        }
                        
                        ?> 
                        <div class="col-lg-4 col-md-6 col-sm-10">
                            <table>
                                <tr><td style="width: 120px;">
                                        <?php echo $elem->describe_elemento; ?></td>
                                    <td style="width:80px;">
                                        <input type="number" class="form-control" name="valor[]" id="<?php echo 'valor' . $j ?>">
                                        <input type="number" hidden class="form-control"  id="<?php echo $j ?>" value="<?='hola'?>">
                                    </td>
                                    <td style="width: 120px;">
                                        <?php echo $segun; ?>
                                    </td>
                                </tr>
                            </table>
                    </div><?php }?>
                    </div>
                </div>
            </div>

            <?php if ($tanques[0]->tanque != 'Tanque1') { ?>
                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-4 col-sm-12">
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
                <div class="row" style="margin-top: 10px; background-color: #e8e8e8; margin-top: 20px;">
                    <?php $granu = \Session::get('granu'); ?>
                    <input type="text" value="' . $granu[0]->id_granu . '" hidden name="idgranu">
                    <div class="col-12">
                        <div style="text-align: center"><h3>Granulometria</h3></div>
                        <div class="row">
                            <?php foreach ($granu as $g) { ?>
                                <div class="col-lg-4 col-sm-12 mt-2">
                                    <?php echo $g->valor . ' <input type="number" class="form-control" name="granulometria[]" value="">' . $g->condicion . ' ' . $g->valor1 . ' ' . $g->simbolo; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
            <div class="row">
                <input type="submit" class="btn btn-info offset-lg-4 col-lg-4 col-sm-12 mt-sm-3" name="boton" value="Introducir">
            </div>
        </form>
        <?php 
        }else{
            echo '<script>nohay()</script>';
        }
        ?>
    </div>


@endsection



