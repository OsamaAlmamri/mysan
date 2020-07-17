<?php $__env->startSection('dataTablesCss'); ?>
    
    
    
    
    
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('dataTablesJs'); ?>
    <script src="<?php echo asset('admin/newLibs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/data-table/extensions/buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/data-table/extensions/buttons/js/jszip.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-buttons/js\buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    
    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php /**PATH F:\sites\mysan\resources\views/admin/common/dataTables.blade.php ENDPATH**/ ?>