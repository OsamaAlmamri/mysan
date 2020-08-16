<?php $__env->startSection('header_h1'); ?>
    <h1><?php echo e(trans('labels.Customer Report')); ?> <small><?php echo e(trans('labels.Customer Report')); ?>...</small> </h1>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <div class="row">
        <div class=" col-md-3 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon"><?php echo e(trans('labels.fromDate')); ?></span>
                <input type="date" class="form-control" name="start" value="<?php echo e(isset($start)?$start:''); ?>"
                       id="from_date">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon"><?php echo e(trans('labels.toDate')); ?></span>
                <input type="date" class="form-control" name="end" value="<?php echo e(isset($end)?$end:''); ?>" required
                       id="to_date">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="input-group ">
                <button type="button" name="filter" id="filter"
                        class="btn btn-primary btn-ms waves-effect waves-light"><?php echo e(trans('labels.filter')); ?> <i
                        class="fa fa-filter"></i></button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class="active"><?php echo e(trans('labels.Customer Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <?php echo $__env->make('admin.common.filters.catetegories_products_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        autoWidth: false,
                        searching: true,
                        language: language,
                        pageLength: 10,
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        buttons: [],
                        ajax: {
                            url: '<?php echo e(route("reports.statsCustomers2")); ?>',
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                from_date: from_date,
                                reportType: '<?php echo e($reportType); ?>',
                                to_date: to_date,
                            }
                        }
                        , columns: [
                            {
                                title: '#',
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                              {
                                title: '<?php echo e(trans('labels.CustomerName')); ?>',
                                data: 'customer',
                                name: 'customer',
                            },
                            {
                                title: '<?php echo e(trans('labels.Email')); ?>',
                                data: 'email',
                                name: 'email',
                            },
                            {
                                title: '<?php echo e(trans('labels.Phone')); ?>',
                                data: 'phone',
                                name: 'phone',
                            }, {
                                title: '<?php echo e(trans('labels.Member Since')); ?>',
                                data: 'created_at',
                                name: 'created_at',
                            }, {
                                title: '<?php echo e(trans('labels.# of orders')); ?>',
                                data: 'total_orders',
                                name: 'total_orders',
                            }, {
                                title: '<?php echo e(trans('labels.TotalPurchased')); ?>',
                                data: 'price',
                                name: 'price',
                            },



                        ]
                    }
                )
                ;
            }

            $('#filter').click(function () {
                ChangeInput();
            });

            function ChangeInput() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(from_date, to_date);
            }

            load_data(null, null);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reports/statsCustomers2.blade.php ENDPATH**/ ?>