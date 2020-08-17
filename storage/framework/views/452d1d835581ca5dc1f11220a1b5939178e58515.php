<?php $__env->startSection('header_h1'); ?>
    <?php if($reportType=='inventory'): ?>
        <h1> <?php echo e(trans('labels.StatsProductsPurchased')); ?> <small><?php echo e(trans('labels.StatsProductsPurchased')); ?>...</small>
        </h1>
    <?php else: ?>
        <h1> <?php echo e(trans('labels.StatsProductsLiked')); ?> <small><?php echo e(trans('labels.StatsProductsLiked')); ?>...</small></h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <?php if($reportType=='inventory'): ?>
        <?php echo $__env->make('admin.common.filters.catetegories_products_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('admin.common.filters.categories_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>
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
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        searching: true,
                        autoWidth: false,
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
                            url: '<?php echo e(route("reports.filter2")); ?>',
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
                                <?php elseif("$reportType"=='inventory'): ?>

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
                            }, {
                                title: '<?php echo e(trans('labels.Reference / Purchase Code')); ?>',
                                data: 'reference_code',
                                name: 'reference_code',
                            }
                            <?php else: ?>
                            {
                                title: '<?php echo e(trans('labels.final_product_orders')); ?>',
                                data: 'final_product_orders',
                                name: 'final_product_orders',
                            }, {
                                title: '<?php echo e(trans('labels.sum_products_quantity')); ?>',
                                data: 'sum_products_quantity',
                                name: 'sum_products_quantity',
                            }, {
                                title: '<?php echo e(trans('labels.count_products_quantity')); ?>',
                                data: 'count_products_quantity',
                                name: 'count_products_quantity',
                            },{
                                title: '<?php echo e(trans('labels.inventory_in_products_quantity')); ?>',
                                data: 'inventory_in_products_quantity',
                                name: 'inventory_in_products_quantity',
                            },{
                                title: '<?php echo e(trans('labels.inventory_in_purchase_price')); ?>',
                                data: 'inventory_in_purchase_price',
                                name: 'inventory_in_purchase_price',
                            },{
                                title: '<?php echo e(trans('labels.inventory_out_products_quantity')); ?>',
                                data: 'inventory_out_products_quantity',
                                name: 'inventory_out_products_quantity',
                            },{
                                title: '<?php echo e(trans('labels.inventory_out_purchase_price')); ?>',
                                data: 'inventory_out_purchase_price',
                                name: 'inventory_out_purchase_price',
                            },{
                                title: '<?php echo e(trans('labels.rating')); ?>',
                                data: 'rating',
                                name: 'rating',
                            },{
                                title: '<?php echo e(trans('labels.product_questions')); ?>',
                                data: 'product_questions',
                                name: 'product_questions',
                            },{
                                title: '<?php echo e(trans('labels.question_replays')); ?>',
                                data: 'question_replays',
                                name: 'question_replays',
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