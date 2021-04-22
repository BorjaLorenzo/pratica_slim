@extends('_template')
@section('cuerpo')
<div class="row">
    <div class="col s4 offset-s4" class="flow-text">
        <p>Tarea modificada con exito!</p>
        <p>{{$insertar}}</p>
        
    </div>
</div>
@endsection
@section('pie')
<a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
@endsection