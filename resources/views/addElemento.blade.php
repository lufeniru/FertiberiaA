@extends('cabeceraLaboratorio')

@section('titulo')
Añadir Elemento
@endsection

@section('cuerpo')
<div class="container" style="text-align: center">
    <form action="addElemento" name="addElemento" method="post">
        {{ csrf_field() }}
        <h3>Advertencia: se está modificando la estructura de la aplicación, podría causar fallos inesperados, no contemplados en el desarrollo de la apliación</h3><br>
        Compuesto al que pertenece: 
        <select name="compuesto">
            <option value="U-18">Compuesto 1</option>
            <option value="Compuesto2">Compuesto 2</option>
        </select><br>
        Nombre completo del elemento: <input type="text" name="nombreElemento">
        Identificador del elemento (ej: Nitrato Total -> NiTot): 
        <input type="text" name="idElem"><br>
        Condición:
        <select name="condicion">
            <option selected="" value="null">Sin condición</option>
            <option value=">"> Mayor que '>'</option>
            <option value="<"> Menor que '<'</option>
            <option value="<>"> Entre '< >'</option>
        </select><br>
        Valor/es de la condición:
        <input type="number" name="valor1" value="0">
        <input type="number" name="valor2" value="0"><br>
        ¿En qué unidad se mide este elemento?
        <input type="text" name="simbolo" value=""><br>
        <input type="submit" name="btAddElemento" value="Aceptar">
    </form>
</div>

@endsection



