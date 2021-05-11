@extends('_template')
@section('cuerpo')
<div class="row">
    <div class="col" class="">
        <table class="highlight centered responsive-table">
            
            <tr>
                <td>Opciones</td>
                <td>ID</td>
                <td>Operario Encargado</td>
                <td>Nombre contacto</td>
                <td>Apellidos contacto</td>
                <td>Telefono</td>
                <td>Descripcion</td>
                <td>Email</td>
                <td>Direccion</td>
                <td>Poblacion</td>
                <td>Codigo Postal</td>
                <td>Provincia</td>
                <td>Estado</td>
                <td>Fecha de creacion</td>
                <td>Fecha de realizacion</td>
                <td>Anotaciones anteriores</td>
                <td>Anotaciones posteriores</td>
            </tr>
            
            
            @foreach($tareas as $tarea)
            <tr>
                <td>
                    <a href="<?=BASE_URL?>realizarTareaBuscar?id_tarea={{$tarea["id"]}}"class="waves-effect waves-light btn-large">Realizada</a>
                    <a href="<?=BASE_URL?>cancelarTareaBuscar?id_tarea={{$tarea["id"]}}" class="waves-effect waves-light btn-large">Cancelada</a>
                </td>
                <td>{{$tarea["id"]}}</td>
                <td>{{$tarea["id_operario"]}}</td>
                <td>{{$tarea["nombre_contacto"]}}</td>
                <td>{{$tarea["apellidos_contacto"]}}</td>
                <td>{{$tarea["telefono"]}}</td>
                <td>{{$tarea["descripcion"]}}</td>
                <td>{{$tarea["email"]}}</td>
                <td>{{$tarea["direccion"]}}</td>
                <td>{{$tarea["poblacion"]}}</td>
                <td>{{$tarea["codigo_postal"]}}</td>
                <td>{{$tarea["provincia"]}}</td>
                <td>{{$tarea["estado"]}}</td>
                <td>{{$tarea["fecha_creacion"]}}</td>
                <td>{{$tarea["fecha_realizacion"]}}</td>
                <td>{{$tarea["anotaciones_ANT"]}}</td>
                <td>{{$tarea["anotaciones_POST"]}}</td>
            </tr>
            @endforeach

        </table>
    </div>
</div>
@endsection
@section('pie')
    <a href="<?= BASE_URL ?>menuOP?id_operario={{$id}}" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection
