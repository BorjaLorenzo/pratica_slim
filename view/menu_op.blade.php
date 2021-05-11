@extends('_template')
@section('errores')
    <p>Menu de Operarios</p>
@endsection
@section('cuerpo')
<div class="row">

    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>tablaTareasOperario?id_operario={{$id}}" class="waves-effect waves-light btn-large">Tabla de tareas</a>
    </div>
    {{-- <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>configuracionOP?id_operario={{$id}}" class="waves-effect waves-light btn-large">Configuracion</a>
    </div> --}}
</div>
<div class="row">
    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>buscadorOP" class="waves-effect waves-light btn-large">Buscador</a>
    </div>
</div>
        
@endsection
@section('pie')
    <a href="<?= BASE_URL ?>cerrarSesion" class="waves-effect waves-light btn-large">Cerrar Sesion</a>
@endsection