@extends('cabecera')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<div class="container">
    <form action="addPlanta" name="addPlanta">
        {{ csrf_field() }}
        Usuario: <input type="email" name="e" value="" alt="Introducir Email" placeholder="Introducir Email">
        Contraseña: <input type="password" name="p" alt="Introducir Contraseña" placeholder="Introducir Contraseña">
        <input type="submit" name="btLogin" value="Aceptar">
    </form>
</div>

@endsection



