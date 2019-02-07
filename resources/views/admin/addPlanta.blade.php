@extends('admin/admin')

@section('titulo')
Añadir Planta
@endsection

@section('cuerpo')
<div class="container">
    <form action="addPlanta" name="addPlanta" method="POST">
        {{ csrf_field() }}
        Nombre de planta: <input type="text" name="nombre" placeholder="ej(UREA)">
        Descripcion: <input type="text" name="descripcion" placeholder="ej(Planta Urea)">
        <input type="submit" name="btAddPlanta" value="Añadir">
    </form>
</div>

@endsection



