
<?php $__env->startSection('cuerpo'); ?>
<form action="<?= BASE_URL ?>checkTareas" method="post">
    <div class="row">
        <div class="col s4 offset-s4">
            Nombre:
            <input type="text" name="nombre" value="<?= Vpost('nombre') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Apellidos:
            <input type="text" name="apellidos" id="apellidos" value="<?= Vpost('apellidos') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Telefono:
            <input type="text" name="telefono" id="telefono" value="<?= Vpost('telefono') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Descripcion:
            <input type="text" name="descripcion" id="descripcion" value="<?= Vpost('descripcion') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Email:
            <input type="text" name="email" id="email" value="<?= Vpost('email') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Direccion:
            <input type="text" name="direccion" id="direccion" value="<?= Vpost('direccion') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Poblacion:
            <input type="text" name="poblacion" id="poblacion" value="<?= Vpost('poblacion') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Codigo Postal:
            <input type="text" name="codigoPostal" id="codigoPostal" value="<?= Vpost('codigoPostal') ?>">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s4 offset-s4">
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
            <input type="text" name="operarioEncargado" id="operarioEncargado" placeholder="ID del Operario" value="<?= Vpost('operarioEncargado') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Anotaciones Anteriores:
            <input type="text" name="anotacionesANT" id="anotacionesANT" value="<?= Vpost('anotacionesANT') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Insertar Tarea<i class="material-icons right"></i></button>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
<a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\projectos\php\pratica_slim\view/tareas.blade.php ENDPATH**/ ?>