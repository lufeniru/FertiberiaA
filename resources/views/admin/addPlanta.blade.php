@extends('admin/admin')

@section('titulo')
Añadir Planta
@endsection

@section('cuerpo')
<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb" class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item"><a href="admin">Administrador</a></li>
                <li class="breadcrumb-item active"aria-current="page">Añadir planta</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <form action="addPlanta" name="addPlanta" method="POST" onsubmit="alerta()" class="row" style="margin-top: 20px">
        {{ csrf_field() }}
        <div class="offset-2 col-3">Nombre de planta: <input type="text" class="form-control" id="planta" name="nombre" placeholder="ej(UREA)"></div>
        <div class="col-3">Descripcion: <input type="text" name="descripcion" class="form-control" placeholder="ej(Planta Urea)"></div>
        <div class="col-4" style="margin-top: 22px"><input type="submit" class="btn btn-info" name="btAddPlanta" value="Añadir"></div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
        function alerta() {
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Planta " + $("#planta").val() + " añadida con exito",
                showConfirmButton: false,
                timer: 1500
            });
        }
</script>
@endsection



