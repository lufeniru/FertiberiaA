@extends('cabecera')

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
    <input type="text" hidden value="<?php echo $elementos[0]->compuesto;?>" name="comp">
    <?php echo 'Compuesto: '. $compuesto[0]->compuesto.'<br>';
    foreach ($elementos as $elem) {
        echo $elem->describe_elemento.': <input type="number" name="valor">';
    }
    if($tanques[0]->tanque != 'Tanque1'){
        echo 'Tanque: <select name="tanque">';
        foreach ($tanques as $t) {
            echo '<option value="'.$t->tanque.'">'.$t->tanque.'</option>';
        }
    }else{
            echo '<input type"text" value="Tanque1" hidden name="tanque">';
        }
    
            ?>
    <input type="submit" class="btn btn-info" name="boton" value="Introducir">
</form>
@endsection



