@extends('cabeceraLaboratorio')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<div class="row">
    <form action="elementos" method="post">
        {{ csrf_field() }}
        <?php
        $compuestos = \Session::get('compuestos');
        echo '<select name="compuesto" class="custom-select offset-2 col-7">';
        echo '<option selected disabled>Elige el compuesto</option>';
        foreach ($compuestos as $comp) {
            echo '<option value="' . $comp->id_compuesto . '">' . $comp->compuesto . '</option>';
        }
        ?>
        <input type="submit" class="btn btn-info offset-2 col-4" name="boton" value="Mostrar">
    </form>
</div>
@endsection



