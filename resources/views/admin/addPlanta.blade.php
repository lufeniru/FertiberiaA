@extends('admin/admin')

@section('titulo')
Añadir Planta
@endsection

@section('cuerpo')
<div class="container">
    <form action="addPlanta" name="addPlanta" method="POST" class="row">
        {{ csrf_field() }}
        <div class="col-6">Nombre de planta: <input type="text" class="form-control" name="nombre" placeholder="ej(UREA)"></div>
        <div class="col-6">Descripcion: <input type="text" name="descripcion" class="form-control" placeholder="ej(Planta Urea)"></div>
        <div class="col-12"><input type="submit" class="btn btn-info" name="btAddPlanta" value="Añadir"></div>
    </form>
</div>

@endsection



