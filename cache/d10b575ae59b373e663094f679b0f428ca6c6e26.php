
<?php $__env->startSection('errores'); ?>
    <?php $__currentLoopData = $errores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($error!=''): ?>
            <p><?php echo e($error); ?></p>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<form action="<?= BASE_URL ?>cambiarPass" method="post">
    <input type="text" name="id" value="<?php echo e($id); ?>" style="visibility: hidden">
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
<a href="<?= BASE_URL ?>menuOP?id_operario=<?php echo e($id); ?>" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\projectos\php\pratica_slim\view/cambiarPAss.blade.php ENDPATH**/ ?>