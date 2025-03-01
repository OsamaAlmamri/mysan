<?php $__env->startSection('header_h1'); ?>
    <h1>  <?php echo e(trans('labels.reviews')); ?> <small><?php echo e(trans('labels.ListingAllReviews')); ?>...</small></h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <?php echo $__env->make('admin.common.filters.catetegories_products_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class="active"> <?php echo e(trans('labels.reviews')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <?php echo $__env->make('admin.common.filters.catetegories_products_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            var firstTime = 1;
            function load_data(product, main, sub, from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        autoWidth: false,
                        searching: true,
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
                        language: language,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        // buttons:
                        //     [],
                        ajax:
                            {
                                url: '<?php echo e(route("reviews.filter2")); ?>',
                                data:
                                    {
                                        _token: "<?php echo e(csrf_token()); ?>",
                                        product: product,
                                        main: main,
                                        sub: sub,
                                        from_date: from_date,
                                        to_date: to_date,
                                    }
                            },

                        columns: [
                            {
                                title: '#',
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false

                            },
                            {
                                title: '<?php echo e(trans('labels.ID')); ?>',
                                data: 'btn_id',
                                name: 'btn_id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },
                            {
                                title: '<?php echo e(trans('labels.products_name')); ?>',
                                data: 'products_name',
                                name: 'products_name',
                            }, {
                                title: '<?php echo e(trans('labels.user')); ?>',
                                data: 'user',
                                name: 'user',
                            }, {
                                title: '<?php echo e(trans('labels.reviews_rating')); ?>',
                                data: 'reviews_rating',
                                name: 'reviews_rating',
                            },
                            {
                                title: '<?php echo e(trans('labels.reviews_text')); ?>',
                                data: 'reviews_text',
                                name: 'reviews_text',
                            },
                            {
                                title: '<?php echo e(trans('labels.Date')); ?>',
                                data: 'created_at',
                                name: 'created_at',
                            },
                            {
                                title: '<?php echo e(trans('labels.Action')); ?>',
                                data: 'manage',
                                name: 'manage',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            }
                        ]
                    }
                );
            }
            $('#filter').click(function () {
                ChangeInput();
            });
            function ChangeInput() {
                var product = $('#products_list').val();
                var main = $('#main_categories').val();
                var sub = $('#subCategories').val();
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(product, main, sub, from_date, to_date);
            }
            load_data('<?php echo e($product_id); ?>', 'all', 'all', null, null);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>