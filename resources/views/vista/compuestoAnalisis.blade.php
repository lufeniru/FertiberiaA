@extends('vista/cabeceraAnalisis')

@section('titulo')
Analisis
@endsection

@section('cuerpo')
<!--parte realizada por Sergio-->
<?php 
$planta= 'PLANTA ' . \Session::get('planta');

?>
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb" class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item"><a href="javascript:window.history.back();">Ver Análisis</a></li>
                <li class="breadcrumb-item active"aria-current="page"><?php echo $planta ?></li>
            </ol>
        </nav>
    </div>
</div>

<form action="elementosAnalisis" class="row" method="post">
    {{ csrf_field() }}
    <?php $compuestos = \Session::get('compuestos');
    echo 'Compuesto: <select name="compuesto" class="custom-select col-4">';
    foreach ($compuestos as $comp) {
        echo '<option value="'.$comp->id_compuesto.'">'.$comp->compuesto.'</option>';
    }
            ?>
    <input type="submit" class="btn btn-info" name="boton" value="Mostrar">
</form>
@endsection



