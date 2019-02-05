@extends('cabeceraLaboratorio')

@section('titulo')
Login
@endsection

@section('cuerpo')
<div class="container">
    <div class="row">
        <div class="offset-4 col-3" style="margin-top: 30px; text-align: center">
            <h2>Login</h2>
            <form action="login" name="login" style="text-align: center">
        {{ csrf_field() }}
        Usuario: <input type="email" name="e" value="" alt="Introducir Email" placeholder="Introducir Email"><br><br>
        Contraseña: <input type="password" name="p" alt="Introducir Contraseña" placeholder="Introducir Contraseña"><br><br>
        <input type="submit" name="btLogin" value="Aceptar">
    </form>
        </div>
    </div>
</div>

@endsection



