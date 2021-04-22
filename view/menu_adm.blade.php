@extends('_template')
@section('errores')
    <p>Menu de Administradores</p>
@endsection
@section('cuerpo')
<div class="row">
    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>tablaTareas" class="waves-effect waves-light btn-large">Tabla de tareas</a>
    </div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>insertarTarea" class="waves-effect waves-light btn-large">Agregar tarea</a>
    </div>
</div>
<div class="row">
    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>tablaUsuarios" class="waves-effect waves-light btn-large">Tabla Usuarios</a>
    </div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>insertarUsuario" class="waves-effect waves-light btn-large">Agregar Usuario</a>
    </div>
</div>

        
@endsection
@section('pie')
    <a href="<?= BASE_URL ?>cerrarSesion" class="waves-effect waves-light btn-large">Cerrar Sesion</a>
@endsection