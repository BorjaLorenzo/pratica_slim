@extends('_template')
@section('errores')
    @foreach($errores as $error)
        @if($error!='')
            <p>{{$error}}</p>
        @endif
    @endforeach
@endsection
@section('cuerpo')
<form action="<?= BASE_URL ?>usuarioModificado" method="post">
    <input type="text" name="id" value="{{$id}}" style="visibility: hidden">
    <div class="row">
        <div class="col s4 offset-s4">
            Nombre:
            <input type="text" name="nombre" value="{{$usuario["nombre"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Apellidos:
            <input type="text" name="apellidos" value="{{$usuario["apellidos"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Contrasena:
            <input type="text" name="pass" value="{{$usuario["pass"]}}">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s4 offset-s4">
            Rol: 
            <select name="rol">
                <option value="administrador" selected>Administrador</option>
                <option value="operario">Operario</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s4 offset-s4">
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Modificar Usuario<i class="material-icons right"></i></button>
        </div>
    </div>
</form>

@endsection
@section('pie')
<a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection