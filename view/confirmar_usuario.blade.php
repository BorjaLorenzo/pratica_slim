@extends('_template')
@section('cuerpo')
<form action="<?= BASE_URL ?>borrarUsuario" method="post">
    <input type="text" name="id_trabajador" value="{{$id}}" style="visibility: hidden">
    <div class="row">
        <div class="col">
            <p>Desea eliminar el usuario {{$nombre}} {{$apellidos}} con ID -> {{$id}} ? <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button></p>
        </div>
    </div>
    
</form>
@endsection
@section('pie')
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection