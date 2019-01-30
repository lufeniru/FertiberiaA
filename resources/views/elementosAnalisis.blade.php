@extends('cabeceraAnalisis')

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
<form action="introducir" method="post">
    {{ csrf_field() }}
    <input type="text" hidden value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    <?php
    echo 'Compuesto: ' . $compuesto[0]->compuesto . '<br>';
    echo '<div class="row">';
    echo '<table><tr>';
    foreach ($elementos as $elem) {

        echo '<td>'.$elem->describe_elemento.'</td>';
        //echo '<div class="col-4">';
        //echo $elem->describe_elemento . ': <input type="number" name="valor">';
        //echo '</div>';
    }
    echo '</table></tr>';
    
    echo '</div>';
    echo '<div class="row">';
    if ($tanques[0]->tanque != 'Tanque1') {
        echo '<div class="col-4">';
        echo 'Tanque: <select name="tanque">';
        foreach ($tanques as $t) {
            echo '<option value="' . $t->tanque . '">' . $t->tanque . '</option>';
        }
        echo '</select>';
        echo '</div>';
    } else {
        echo '<input type"text" value="Tanque1" hidden name="tanque">';
    }
    echo '</div>';
    if ($compuesto[0]->granulometria != null) {
        echo '<div class="row">';
        $granu = \Session::get('granu');
        echo '<input type="text" value="' . $granu[0]->id_granu . '" hidden name="idgranu">';
        echo '<fieldset>';
        echo '<legend>Granulometria</legend>';
        foreach ($granu as $g) {
             echo '<div class="col-3">';
            echo $g->valor . ' <input type="number" name="granulometria[]">' . $g->condicion . ' ' . $g->valor1 . ' ' . $g->simbolo;
            echo '</div>';
        }
        echo '</fieldset>';
        echo '</div>';
    }
    ?>
    <input type="submit" class="btn btn-info" name="boton" value="Introducir">
</form>
@endsection



