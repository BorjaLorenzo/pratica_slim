@extends('_template')
@section('errores')
    @foreach($errores as $error)
        @if($error!='')
            <p>{{$error}}</p>
        @endif
    @endforeach
@endsection
@section('cuerpo')
<form action="<?= BASE_URL ?>cambiarPass" method="post">
    <input type="text" name="id" value="{{$id}}" style="visibility: hidden">
    <div class="row">
        <div class="col s4 offset-s4">
            Nueva Contrasena:
            <input type="text" name="pass1" value="<?= Vpost('pass1') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Repetir Nueva Contrasena:
            <input type="text" name="pass2" value="<?= Vpost('pass2') ?>">
        </div>
    </div>

    <div class="row">
        <div class="col s4 offset-s4">
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </div>
    </div>
</form>

@endsection
@section('pie')
<a href="<?= BASE_URL ?>menuOP?id_operario={{$id}}" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection