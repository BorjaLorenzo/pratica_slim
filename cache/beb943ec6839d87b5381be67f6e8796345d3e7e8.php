
<?php $__env->startSection('errores'); ?>
    <p>Menu de Operarios</p>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cuerpo'); ?>
<div class="row">

    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>tablaTareasOperario?id_operario=<?php echo e($id); ?>" class="waves-effect waves-light btn-large">Tabla de tareas</a>
    </div>
    
</div>
<div class="row">
    <div class="col s4"></div>
    <div class="col" class="flow-text">
        <a href="<?= BASE_URL ?>buscadorOP" class="waves-effect waves-light btn-large">Buscador</a>
    </div>
</div>
        
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>cerrarSesion" class="waves-effect waves-light btn-large">Cerrar Sesion</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim_G\view/menu_op.blade.php ENDPATH**/ ?>