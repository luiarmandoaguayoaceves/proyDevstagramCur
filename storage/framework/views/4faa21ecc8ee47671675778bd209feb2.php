<?php $__env->startSection('titulo'); ?>
    Pagina principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    Contenido de esta pagina
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/principal.blade.php ENDPATH**/ ?>