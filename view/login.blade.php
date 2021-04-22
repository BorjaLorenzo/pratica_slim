@extends('_template')
@section('cuerpo')
<div class="row">
    <div class="col s4 offset-s4" class="flow-text">
        <form action="<?= BASE_URL ?>checkLogin" method="post">
            <p>USUARIO: <input type="text" name="usuario_inicio" id="usuario_inicio"></p>
            <p>CONSTRASEÑA: <input type="text" name="pass" id="contraseña"></p>
            <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </form>
    </div>
</div>
@endsection