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
        <div class="col s4 offset-s4">
            Fecha creacion:
            <input type="date" name="fechaI">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="valorI" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Fecha realizacion:
            <input type="date" name="fechaF" id="">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="valorF" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class=" col s4 offset-s4">
            Provincia: 
            <select name="provincia" id="provincia">
                <option value="" selected disabled></option>
                <option value="Huelva">Huelva</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Cordoba">Cordoba</option>
                <option value="Cadiz">Cadiz</option>
                <option value="Jaen">Jaen</option>
                <option value="Malaga">Malaga</option>
                <option value="Almeria">Almeria</option>
                <option value="Granada">Granada</option>
            </select>
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