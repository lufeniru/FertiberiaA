@extends('admin/admin')

@section('titulo')
Añadir Planta
@endsection

@section('cuerpo')
<div class="container">
    <form action="addPlanta" name="addPlanta" method="POST" class="row" style="margin-top: 20px">
        {{ csrf_field() }}
        <div class="offset-2 col-3">Nombre de planta: <input type="text" class="form-control" name="nombre" placeholder="ej(UREA)"></div>
        <div class="col-3">Descripcion: <input type="text" name="descripcion" class="form-control" placeholder="ej(Planta Urea)"></div>
        <div class="col-4" style="margin-top: 22px"><input type="submit" class="btn btn-info" name="btAddPlanta" value="Añadir"></div>
    </form>
</div>

@endsection



