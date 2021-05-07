
<?php $__env->startSection('cuerpo'); ?>
<div class="row">
    <div class="col" class="">
        <table class="highlight centered responsive-table">
            
            <tr>
                <td>Opciones</td>
                <td>ID</td>
                <td>Operario Encargado</td>
                <td>Nombre contacto</td>
                <td>Apellidos contacto</td>
                <td>Telefono</td>
                <td>Descripcion</td>
                <td>Email</td>
                <td>Direccion</td>
                <td>Poblacion</td>
                <td>Codigo Postal</td>
                <td>Provincia</td>
                <td>Estado</td>
                <td>Fecha de creacion</td>
                <td>Fecha de realizacion</td>
                <td>Anotaciones anteriores</td>
                <td>Anotaciones posteriores</td>
            </tr>
            
            
            <?php $__currentLoopData = $tareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <a href="<?=BASE_URL?>modificarTarea?id_tarea=<?php echo e($tarea["id"]); ?>" class="waves-effect waves-light btn-large">Modificar</a>
                    <a href="<?=BASE_URL?>borrarTarea?id_tarea=<?php echo e($tarea["id"]); ?>" class="waves-effect waves-light btn-large">Eliminar</a>
                </td>
                <td><?php echo e($tarea["id"]); ?></td>
                <td><?php echo e($tarea["id_operario"]); ?></td>
                <td><?php echo e($tarea["nombre_contacto"]); ?></td>
                <td><?php echo e($tarea["apellidos_contacto"]); ?></td>
                <td><?php echo e($tarea["telefono"]); ?></td>
                <td><?php echo e($tarea["descripcion"]); ?></td>
                <td><?php echo e($tarea["email"]); ?></td>
                <td><?php echo e($tarea["direccion"]); ?></td>
                <td><?php echo e($tarea["poblacion"]); ?></td>
                <td><?php echo e($tarea["codigo_postal"]); ?></td>
                <td><?php echo e($tarea["provincia"]); ?></td>
                <td><?php echo e($tarea["estado"]); ?></td>
                <td><?php echo e($tarea["fecha_creacion"]); ?></td>
                <td><?php echo e($tarea["fecha_realizacion"]); ?></td>
                <td><?php echo e($tarea["anotaciones_ANT"]); ?></td>
                <td><?php echo e($tarea["anotaciones_POST"]); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>menuADM" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim_G\view/lista_tareas.blade.php ENDPATH**/ ?>