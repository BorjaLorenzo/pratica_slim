<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestor Tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        $(document).ready(function () {
            //para que funcione el select con materialize
            $('select').formSelect();
        });
    </script>
</head>

<body>
    <header>
        <div style="background: #ccffff; text-align: center; font-size: 2em">
            DESATRANQUES JAEN
        </div>
    </header>
    <div class="card-panel #ff5252 red accent-2">
        <?php echo $__env->yieldContent('errores'); ?>
    </div>
    <div id="container">
        <?php echo $__env->yieldContent('cuerpo'); ?>
    </div>
    <footer class="card-panel #d4e157 lime lighten-1">
        <?php echo $__env->yieldContent('pie'); ?>
    </footer>
</body>

</html><?php /**PATH D:\xampp\htdocs\projectos\php\pratica_slim\view/_template.blade.php ENDPATH**/ ?>