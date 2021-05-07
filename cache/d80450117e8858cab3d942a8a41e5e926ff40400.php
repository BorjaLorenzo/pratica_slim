
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
        <div class="col s4 offset-s4">
            Fecha creacion:
            <input type="date" name="fechaI">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="valorI" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            Fecha realizacion:
            <input type="date" name="fechaF" id="">
            
        </div>
        <div class="col">
            <label for="">Valor: <select name="valorF" id="">
                <option value="=">=</option>
                <option value=">">></option>
                <option value="<"><</option>
            </select></label>
        </div>
    </div>
    <div class="row">
        <div class=" col s4 offset-s4">
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
        <button class="btn waves-effect waves-light" type="submit" name="botonInicio">Confirmar<i class="material-icons right"></i></button>
        </div>
    </div>
</form>
<?php $__env->startSection('pie'); ?>
    <a href="<?= BASE_URL ?>menuOP?id_operario=<?php echo e($id); ?>" class="waves-effect waves-light btn-large">Volver al menu</a>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim\view/buscadorOP.blade.php ENDPATH**/ ?>