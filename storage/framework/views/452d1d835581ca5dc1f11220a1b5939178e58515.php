<?php $__env->startSection('header_h1'); ?>
    <?php if($reportType=='inventory'): ?>
        <h1> <?php echo e(trans('labels.StatsProductsPurchased')); ?> <small><?php echo e(trans('labels.StatsProductsPurchased')); ?>...</small>
        </h1>
    <?php else: ?>
        <h1> <?php echo e(trans('labels.StatsProductsLiked')); ?> <small><?php echo e(trans('labels.StatsProductsLiked')); ?>...</small></h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <?php echo $__env->make('admin.common.filters.categories_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <?php if($reportType=='inventory'): ?>
        <li class="active"><?php echo e(trans('labels.StatsProductsPurchased')); ?></li>
    <?php else: ?>
        <li class="active"><?php echo e(trans('labels.StatsProductsLiked')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <?php echo $__env->make('admin.common.filters.catetegories_products_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(main, sub, from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
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
                            url: '<?php echo e(route("statsProductsPurchased.filter2")); ?>',
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                main: main,
                                sub: sub,
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
                                title: '<?php echo e(trans('labels.ID')); ?>',
                                data: 'products_id',
                                name: 'products_id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },
                            {
                                title: '<?php echo e(trans('labels.Image')); ?>',
                                data: 'btn_image',
                                name: 'btn_image',
                            }, {
                                title: '<?php echo e(trans('labels.Category')); ?>',
                                data: 'categories_name',
                                name: 'categories_name',
                            },
                            {
                                title: '<?php echo e(trans('labels.Name')); ?>',
                                data: 'products_name',
                                name: 'products_name',
                            },
                                <?php if("$reportType"=='like'): ?>
                            {
                                title: '<?php echo e(trans('labels.Liked')); ?>',
                                data: 'products_liked',
                                name: 'products_liked',
                            }
                                <?php else: ?>
                            {
                                title: '<?php echo e(trans('labels.PurchasedDate')); ?>',
                                data: 'created_at',
                                name: 'created_at',
                            }, {
                                title: '<?php echo e(trans('labels.UpdatedDate')); ?>',
                                data: 'updated_at',
                                name: 'updated_at',
                            }, {
                                title: '<?php echo e(trans('labels.Stock')); ?>',
                                data: 'stock',
                                name: 'stock',
                            }, {
                                title: '<?php echo e(trans('labels.Price')); ?>',
                                data: 'purchase_price',
                                name: 'purchase_price',
                            }
                            <?php endif; ?>

                        ]
                    }
                )
                ;
            }

            $('#filter').click(function () {
                ChangeInput();
            });

            function ChangeInput() {
                var main = $('#main_categories').val();
                var sub = $('#subCategories').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(main, sub, from_date, to_date);
            }

            load_data('all', 'all', null, null);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reports/showProductsReoprts.blade.php ENDPATH**/ ?>