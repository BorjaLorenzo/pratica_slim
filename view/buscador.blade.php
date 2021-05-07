@extends('_template')
@section('errores')
@foreach($errores as $error)
@if($error!='')
    <p>{{$error}}</p>
@endif
@endforeach
@endsection
@section('cuerpo')
<form action="<?= BASE_URL ?>buscar" method="post">
    {{-- <input type="text" name="id" value="{{$id}}" style="visibility: hidden"> --}}
    <div class="row">
        <div class="col offset-s2">
            Opcion 1:
            <input type="text" name="op1">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="vop1" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
        <div class="col">
            <label for="">Seccion: <select name="sop1" id="">
                <option value="" selected></option>
                <option value="id_operario">ID Operario</option>
                <option value="nombre_contacto">Nombre</option>
                <option value="apellidos_contacto">Apellidos</option>
                <option value="telefono">Telefono</option>
                <option value="descripcion">Descripcion</option>
                <option value="email">Email</option>
                <option value="direccion">Direccion</option>
                <option value="poblacion">Poblacion</option>
                <option value="codigo_postal">Codigo postal</option>
                <option value="provincia">Provincia</option>
                <option value="estado">Estado</option>
                <option value="fecha_creacion">Fecha creacion</option>
                <option value="fecha_realizacion">Fecha realizacion</option>
                <option value="anotaciones_ANT">Anotaciones anteriores</option>
                <option value="anotaciones_POST">Anotaciones posteriores</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class="col offset-s2">
            Opcion 2:
            <input type="text" name="op2">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="vop2" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
        <div class="col">
            <label for="">Seccion: <select name="sop2" id="">
                <option value="" selected></option>
                <option value="id_operario">ID Operario</option>
                <option value="nombre_contacto">Nombre</option>
                <option value="apellidos_contacto">Apellidos</option>
                <option value="telefono">Telefono</option>
                <option value="descripcion">Descripcion</option>
                <option value="email">Email</option>
                <option value="direccion">Direccion</option>
                <option value="poblacion">Poblacion</option>
                <option value="codigo_postal">Codigo postal</option>
                <option value="provincia">Provincia</option>
                <option value="estado">Estado</option>
                <option value="fecha_creacion">Fecha creacion</option>
                <option value="fecha_realizacion">Fecha realizacion</option>
                <option value="anotaciones_ANT">Anotaciones anteriores</option>
                <option value="anotaciones_POST">Anotaciones posteriores</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class="col offset-s2">
            Opcion 3:
            <input type="text" name="op3">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="vop3" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
        <div class="col">
            <label for="">Seccion: <select name="sop3" id="">
                <option value="" selected></option>
                <option value="id_operario">ID Operario</option>
                <option value="nombre_contacto">Nombre</option>
                <option value="apellidos_contacto">Apellidos</option>
                <option value="telefono">Telefono</option>
                <option value="descripcion">Descripcion</option>
                <option value="email">Email</option>
                <option value="direccion">Direccion</option>
                <option value="poblacion">Poblacion</option>
                <option value="codigo_postal">Codigo postal</option>
                <option value="provincia">Provincia</option>
                <option value="estado">Estado</option>
                <option value="fecha_creacion">Fecha creacion</option>
                <option value="fecha_realizacion">Fecha realizacion</option>
                <option value="anotaciones_ANT">Anotaciones anteriores</option>
                <option value="anotaciones_POST">Anotaciones posteriores</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </div>
    </div>
</form>
@section('pie')
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection
@endsection