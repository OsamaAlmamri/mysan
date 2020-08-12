<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('dataTablesCss'); ?>
        <link href="<?php echo asset('admin/newLibs/data-table/css/buttons.dataTables.min.css'); ?>" media="all" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo asset('admin/newLibs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>"
              media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo asset('admin/newLibs/data-table/extensions/responsive/css/responsive.dataTables.css'); ?>"
              media="all" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('dataTablesJs'); ?>
    <script src="<?php echo asset('admin/newLibs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/data-table/extensions/buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/data-table/extensions/buttons/js/jszip.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-buttons/js\buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/newLibs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    
    <?php if(isset($dataTableType) and  $dataTableType=='php'): ?>
        <?php $__env->startPush('js'); ?>
            <?php echo $dataTable->scripts(); ?>

        <?php $__env->stopPush(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <?php echo $__env->yieldContent('header_h1'); ?>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i
                            class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <?php echo $__env->yieldContent('header'); ?>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <?php echo $__env->yieldContent('filters'); ?>
                            <?php echo $__env->make('admin.common.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->yieldContent('btn_add'); ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(isset($dataTableType) and  $dataTableType=='php'): ?>
                                        <?php echo $dataTable->table(['class'=>'dataTable table table-striped table-hover table table-bordered' ],true); ?>

                                    <?php else: ?>
                                        <table id="orderdata"
                                               class="dataTable table table-striped table-hover table table-bordered table-dark">
                                        </table>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <?php echo $__env->yieldContent('modals'); ?>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var language = {
            lengthMenu: "Show _MENU_ Entries",

            sSearch: '<?php echo e(trans('dataTable.sSearch')); ?>',
            info: "Showing _START_ to _END_ of _TOTAL_ Entries",
            sEmptyTable: '<?php echo e(trans('dataTable.sEmptyTable')); ?>',
            sInfo: '<?php echo e(trans('dataTable.sInfo')); ?>',
            sInfoEmpty: '<?php echo e(trans('dataTable.sInfoEmpty')); ?>',
            sInfoFiltered: '<?php echo e(trans('dataTable.sInfoFiltered')); ?>',
            sInfoPostFix: '<?php echo e(trans('dataTable.sInfoPostFix')); ?>',
            sLengthMenu: '<?php echo e(trans('dataTable.sLengthMenu')); ?>',
            sInfoThousands: '<?php echo e(trans('dataTable.sInfoThousands')); ?>',
            sLoadingRecords: '<?php echo e(trans('dataTable.sLoadingRecords')); ?>',
            sProcessing: '<?php echo e(trans('dataTable.sProcessing')); ?>',
            sZeroRecords: '<?php echo e(trans('dataTable.sZeroRecords')); ?>',
            sSearch: '<?php echo e(trans('dataTable.sSearch')); ?>',
            oPaginate: {
                sNext: '<?php echo e(trans('dataTable.sNext')); ?>',
                sPrevious: '<?php echo e(trans('dataTable.sPrevious')); ?>',
                sFirst: '<?php echo e(trans('dataTable.sFirst')); ?>',
                sLast: '<?php echo e(trans('dataTable.sLast')); ?>',
            },
            oAria: {
                sSortAscending: '<?php echo e(trans('dataTable.sSortAscending')); ?>',
                sSortDescending: '<?php echo e(trans('dataTable.sSortDescending')); ?>',
            },
        };

    </script>
    <?php echo $__env->yieldContent('custom_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/dataTable_layaout.blade.php ENDPATH**/ ?>