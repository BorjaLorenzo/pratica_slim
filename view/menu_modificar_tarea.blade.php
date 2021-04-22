@extends('_template')
@section('errores')
@foreach($errores as $error)
    @if($error!='')
        <p>{{$error}}</p>
    @endif
@endforeach
@endsection
@section('cuerpo')
<form action="<?= BASE_URL ?>tareamodificada" method="post">
    <input type="text" name="id" value="{{$id}}" style="visibility: hidden">
    <div class="row">
        <div class="col s4 offset-s4">
            Nombre:
            <input type="text" name="nombre" value="{{$tarea["nombre_contacto"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Apellidos:
            <input type="text" name="apellidos" id="apellidos" value="{{$tarea["apellidos_contacto"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Telefono:
            <input type="text" name="telefono" id="telefono" value="{{$tarea["telefono"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Descripcion:
            <input type="text" name="descripcion" id="descripcion" value="{{$tarea["descripcion"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Email:
            <input type="text" name="email" id="email" value="{{$tarea["email"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Direccion:
            <input type="text" name="direccion" id="direccion" value="{{$tarea["direccion"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Poblacion:
            <input type="text" name="poblacion" id="poblacion" value="{{$tarea["poblacion"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Codigo Postal:
            <input type="text" name="codigoPostal" id="codigoPostal" value="{{$tarea["codigo_postal"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Provincia: <?=
                            CreaSelect(
                                'provincia',
                                array(
                                    '' => '',
                                    'Huelva' => 'Huelva',
                                    'Sevilla' => 'Sevilla',
                                    'Cordoba' => 'Cordoba',
                                    'Cadiz' => 'Cadiz',
                                    'Jaen' => 'Jaen',
                                    'Malaga' => 'Malaga',
                                    'Almeria' => 'Almeria',
                                    'Granada' => 'Granada'
                                ),
                                Vpost('provincia')
                            ) ?>
            <?= Vpost('provincia') == 'Huelva' ?
                ' selected ' :
                '' ?>
    
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Estado:
            <p>
                <label for="estadoP">
                    <input type="radio" class="with-gap" name="estado" id="estadoP" value="Pendiente" checked>
                    <span>Pendiente</span>
                </label>
            </p>
            <p>
                <label for="estadoR">
                    <input type="radio" class="with-gap" name="estado" id="estadoR" value="Realizada">
                    <span>Realizada</span>
                </label>
            </p>
            <p>
                <label for="estadoC">
                    <input type="radio" class="with-gap" name="estado" id="estadoC" value="Cancelada">
                    <span>Cancelada</span>
                </label>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Operario Encargado:
            <input type="text" name="operarioEncargado"  placeholder="ID del Operario" value="{{$tarea["id_operario"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Anotaciones Posteriores:
            <input type="text" name="anotacionesPOST"  value="{{$tarea["anotaciones_POST"]}}">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </div>
    </div>
</form>
@section('pie')
<a href="<?= BASE_URL ?>menuADM">Volver al menu</a>
@endsection
@endsection