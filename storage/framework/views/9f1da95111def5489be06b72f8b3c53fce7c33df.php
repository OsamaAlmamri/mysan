<?php $__env->startSection('content'); ?>
<?php $r =   'auth.logins.login' . $final_theme['login']; ?>
<?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/auth/login.blade.php ENDPATH**/ ?>