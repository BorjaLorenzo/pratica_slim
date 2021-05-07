
<?php $__env->startSection('errores'); ?>
    <p>Menu de Operarios</p>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<div class="row">

    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>tablaTareasOperario?id_operario=<?php echo e($id); ?>" class="waves-effect waves-light btn-large">Tabla de tareas</a>
    </div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>configuracionOP?id_operario=<?php echo e($id); ?>" class="waves-effect waves-light btn-large">Configuracion</a>
    </div>
</div>

        
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>cerrarSesion" class="waves-effect waves-light btn-large">Cerrar Sesion</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\projectos\php\pratica_slim\view/menu_op.blade.php ENDPATH**/ ?>