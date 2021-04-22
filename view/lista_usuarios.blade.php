@extends('_template')
@section('cuerpo')
<div class="row">
    <div class="col s2"></div>
    <div class="col s8" class="">
        <table class="highlight centered responsive-table">
            
            <tr>
                <td>Opciones</td>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Rol/Puesto</td>
            </tr>
            @foreach($usuarios as $usuario)
            <tr>
                <td>
                    <a href="<?=BASE_URL?>modificarUsuario?id_trabajador={{$usuario["id_trabajador"]}}" class="waves-effect waves-light btn-large">Modificar</a>
                    <a href="<?=BASE_URL?>borrarUsuario?id_trabajador={{$usuario["id_trabajador"]}}" class="waves-effect waves-light btn-large">Eliminar</a>
                </td>
                <td>{{$usuario["id_trabajador"]}}</td>
                <td>{{$usuario["nombre"]}}</td>
                <td>{{$usuario["apellidos"]}}</td>
                <td>{{$usuario["rol"]}}</td>
            </tr>
            @endforeach

        </table>
    </div>
    <div class="col s2"></div>
</div>
@endsection
@section('pie')
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection
