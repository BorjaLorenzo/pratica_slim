
<?php $__env->startSection('cuerpo'); ?>
<form action="<?= BASE_URL ?>borrarTarea" method="post">
    <input type="text" name="id_tarea" value="<?php echo e($id_tarea); ?>" style="visibility: hidden">
    <div class="row">
        <div class="col">
            <p>Desea eliminar la tarea con ID -> <?php echo e($id_tarea); ?> ? <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button></p>
        </div>
    </div>
    
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim_G\view/confirmar_eliminar.blade.php ENDPATH**/ ?>