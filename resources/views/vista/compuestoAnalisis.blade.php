@extends('vista/cabeceraAnalisis')

@section('titulo')
Analisis
@endsection

@section('cuerpo')
<form action="elementosAnalisis" method="post">
    {{ csrf_field() }}
    <?php $compuestos = \Session::get('compuestos');
    echo 'Compuesto: <select name="compuesto">';
    foreach ($compuestos as $comp) {
        echo '<option value="'.$comp->id_compuesto.'">'.$comp->compuesto.'</option>';
    }
            ?>
    <input type="submit" class="btn btn-info" name="boton" value="Mostrar">
</form>
@endsection



