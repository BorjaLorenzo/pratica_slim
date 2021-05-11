
<?php $__env->startSection('errores'); ?>
<?php $__currentLoopData = $errores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($error!=''): ?>
    <p><?php echo e($error); ?></p>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<form action="<?= BASE_URL ?>buscar" method="post">
    
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
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim_G\view/buscador.blade.php ENDPATH**/ ?>