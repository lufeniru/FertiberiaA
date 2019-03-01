@extends('laboratorio/cabeceraLaboratorio')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<?php $existe = \Session::get('planta'); ?>
    <!--parte realizada por Jaime-->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-12">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item"><a href="lab">Laboratorio</a></li>
                <li class="breadcrumb-item active" aria-current="page">PLANTA <?php echo $existe; ?></li>
            </ol>
        </nav>
    </div>
    <!--parte realizada por Jaime-->
    <div class="row">
        <form action="elementos" method="post" class="col-12">
            {{ csrf_field() }}
            <?php
            $compuestos = \Session::get('compuestos');
            echo '<select name="compuesto" class="custom-select offset-2 col-lg-7">';
            foreach ($compuestos as $comp) {
                echo '<option value="' . $comp->id_compuesto . '">' . $comp->compuesto . '</option>';
            }
            ?>
            <input type="submit" class="btn btn-info offset-2 col-2" name="boton" value="Mostrar">
        </form>
    </div>
@endsection



