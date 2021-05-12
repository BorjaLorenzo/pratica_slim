
<?php $__env->startSection('cuerpo'); ?>
<div class="row">
    <div class="col s2"></div>
    <div class="col s8" class="">
        <table class="highlight centered responsive-table">
            
            <tr>
                <td>Opciones</td>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Rol/Puesto</td>
            </tr>
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <a href="<?=BASE_URL?>modificarUsuario?id_trabajador=<?php echo e($usuario["id_trabajador"]); ?>" class="waves-effect waves-light btn-large">Modificar</a>
                    <a href="<?=BASE_URL?>confirmarEliminarUsuario?id_trabajador=<?php echo e($usuario["id_trabajador"]); ?>" class="waves-effect waves-light btn-large">Eliminar</a>
                </td>
                <td><?php echo e($usuario["id_trabajador"]); ?></td>
                <td><?php echo e($usuario["nombre"]); ?></td>
                <td><?php echo e($usuario["apellidos"]); ?></td>
                <td><?php echo e($usuario["rol"]); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </table>
    </div>
    <div class="col s2"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim_G\view/lista_usuarios.blade.php ENDPATH**/ ?>