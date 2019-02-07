@extends('admin/admin')

@section('titulo')
Añadir Elemento
@endsection

@section('cuerpo')
<div class="container" style="text-align: center">
    <form action="addElemento" name="addElemento" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12"><h3>Advertencia: se está modificando la estructura de la aplicación, podría causar fallos inesperados, no contemplados en el desarrollo de la aplicación</h3></div>

            <div class="col-6"><h4>Planta:</h4> <select name="planta" class="custom-select" id="planta">
                    <?php
                    foreach ($plantas as $p) {
                        echo '<option value="' . $p->id_planta . '">' . $p->nombre . '</option>';
                    }
                    ?>
                </select></div>
           
        </div>
        <div class="row">
            <div class="col-6"><h4>Nombre completo del compuesto:</h4> <input type="text" class="form-control" name="nombreComp"></div>
            <div class="col-6"> <h4>Identificador del compuesto:</h4> <input type="text" class="form-control" name="idComp" placeholder="(ej: Urea -> U-18)"></div>
            
        </div>
       
        <div class="row">
            <div class="col-6">
                <input type="submit" class="btn btn-info" name="btAddElemento" value="Aceptar">
            </div>
        </div>

</form>
</div>


@endsection



