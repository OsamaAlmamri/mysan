<?php $__env->startSection('header_h1'); ?>
    <h1> <?php echo e(trans('labels.Products')); ?> <small><?php echo e(trans('labels.ListingAllProducts')); ?>...</small></h1>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('btn_add'); ?>
    <div class="box-tools pull-left">
        <a href="<?php echo e(URL::to('admin/products/add')); ?>" type="button"
           class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <?php echo $__env->make('admin.common.filters.categories_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class="active"> <?php echo e(trans('labels.Products')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <?php echo $__env->make('admin.common.filters.catetegories_products_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.common.active', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        Active("<?php echo e(route('products.active')); ?>");
    </script>
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
                            url: '<?php echo e(route("products.filter2")); ?>',
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                main: main,
                                sub: sub,
                                from_date: from_date,
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
                                // 'render': function (data, type, row) {
                                //     return (data == '1') ? 'نعم ' : 'لا';
                                // }
                            },
                            {
                                title: '<?php echo e(trans('labels.Additional info')); ?>',
                                data: 'info',
                                name: 'info',
                            }, {
                                title: '<?php echo e(trans('labels.rating')); ?>',
                                data: 'rating',
                                name: 'rating',
                            },
                            {
                                title: '<?php echo e(trans('labels.ModifiedDate')); ?>',
                                data: 'productupdate',
                                name: 'productupdate',
                            },
                            {
                                title: '<?php echo e(trans('labels.Status')); ?>',
                                data: 'status',
                                name: 'status',
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
    <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog"
         aria-labelledby="deleteProductModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteProductModalLabel"><?php echo e(trans('labels.DeleteProduct')); ?></h4>
                </div>
                <?php echo Form::open(array('url' =>'admin/products/delete', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                <?php echo Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')); ?>

                <div class="modal-body">
                    <p><?php echo e(trans('labels.DeleteThisProductDiloge')); ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                    <button type="submit" class="btn btn-primary"
                            id="deleteProduct"><?php echo e(trans('labels.DeleteProduct')); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/products/index2.blade.php ENDPATH**/ ?>