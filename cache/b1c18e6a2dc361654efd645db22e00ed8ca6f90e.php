
<?php $__env->startSection('errores'); ?>
<span><?php echo e($descripcion_error); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<div class="row">
    <div class="col s4 offset-s4" class="flow-text">
        <form action="<?= BASE_URL ?>checkLogin" method="post">
            <p>USUARIO: <input type="text" name="usuario_inicio" id="usuario_inicio"></p>
            <p>CONSTRASEÑA: <input type="text" name="pass" id="contraseña"></p>
            <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\projectos\php\pratica_slim\view/login_error.blade.php ENDPATH**/ ?>