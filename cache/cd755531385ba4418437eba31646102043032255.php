
<?php $__env->startSection('errores'); ?>
    <?php $__currentLoopData = $errores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($error!=''): ?>
            <p><?php echo e($error); ?></p>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<form action="<?= BASE_URL ?>checkUsuario" method="post">
    <div class="row">
        <div class="col s4 offset-s4">
            Nombre:
            <input type="text" name="nombre" value="<?= Vpost('nombre') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Apellidos:
            <input type="text" name="apellidos" value="<?= Vpost('apellidos') ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Contrasena:
            <input type="text" name="pass" value="<?= Vpost('pass') ?>">
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
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Insertar Usuario<i class="material-icons right"></i></button>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
<a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim\view/insertarUsuario.blade.php ENDPATH**/ ?>