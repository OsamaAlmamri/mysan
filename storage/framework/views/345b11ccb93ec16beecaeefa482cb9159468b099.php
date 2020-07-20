<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
<head>
    <?php echo $__env->make('admin.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('dataTablesCss'); ?>
    <?php echo $__env->yieldContent('css'); ?>

</head>
<!-- ./end of meta -->


<body class="hold-transition skin-blue sidebar-mini" >
<!-- wrapper -->
<div class="wrapper">

    <!-- header contains top navbar -->
<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of header -->

    <!-- left sidebar -->
<?php echo $__env->make('admin.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of left sidebar -->

    <!-- dynamic content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- ./end of dynamic content -->

    <!-- right sidebar -->
<?php echo $__env->make('admin.common.controlsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./right sidebar -->
    <?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->
<!-- all js scripts including custom js -->
<?php echo $__env->make('admin.common.libs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('dataTablesJs'); ?>
<?php echo $__env->yieldContent('scripts'); ?>

<?php echo $__env->yieldContent('dataTableImport'); ?>
<?php echo $__env->make('admin.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ./end of js scripts -->
<?php echo $__env->yieldPushContent('js'); ?>
<?php echo $__env->yieldPushContent('css'); ?>
</body>
</html>
<?php /**PATH F:\sites\mysan\resources\views/admin/layout.blade.php ENDPATH**/ ?>