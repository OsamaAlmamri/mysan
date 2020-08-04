<?php $__env->startSection('header_h1'); ?>
    <h1> <?php echo e(trans('labels.Bouquets')); ?> <small>...</small></h1>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('btn_add'); ?>
    <div class="box-tools pull-left">
        <a href="<?php echo e(route('bouquets.create')); ?>" type="button"
           class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class="active"> <?php echo e(trans('labels.Bouquets')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

    <script>
        $(document).ready(function () {
            var firstTime = 1;

            function load_data(from_date, to_date) {
                $('#orderdata').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        scrollX: true,
                        width: "100%",
                        responsive: true,
                        searching: true,
                        language: language,
                        pageLength: 10,
                        'createdRow': function (row, data, dataIndex) {
                            $(row).addClass('row1');
                            $(row).attr('data-id', data.bouquet_id);
                            $(row).attr('width', "100%");
                        },
                        search: [
                            regex => true,
                        ],
                        info: false,
                        searchDelay: 350,
//                         dom: 'Blftip',
                        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                        buttons: [],
                        ajax: {
                            url: '<?php echo e(route("bouquets.filter2")); ?>',
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                from_date: from_date,
                                to_date: to_date,
                            }
                        }, columns: [
                            {
                                name: 'btn_sort',
                                data: 'btn_sort',
                                title: '<?php echo e(trans('labels.btn_sort')); ?>'
                            },
                            {
                                title: '<?php echo e(trans('labels.Name')); ?>',
                                data: 'bouquet_name_ar',
                                name: 'bouquet_name_ar',
                            },

                            {
                                title: '<?php echo e(trans('labels.Image')); ?>',
                                data: 'btn_image',
                                name: 'btn_image',
                            },

                            {
                                title: '<?php echo e(trans('labels.Price')); ?>',
                                data: 'bouquet_price',
                                name: 'bouquet_price',
                            },
                            {
                                title: '<?php echo e(trans('labels.count')); ?>',
                                data: 'count',
                                name: 'count',
                            },
                            {
                                title: '<?php echo e(trans('labels.sold_count')); ?>',
                                data: 'sold_count',
                                name: 'sold_count',
                            },
                            {
                                title: '<?php echo e(trans('labels.expiry_date')); ?>',
                                data: 'expiry_date',
                                name: 'expiry_date',
                            }, {
                                title: '<?php echo e(trans('labels.free_shipping')); ?>',
                                data: 'free_shipping',
                                name: 'free_shipping',
                            render:function (data) {
                                    return (data==0)?"لا":"نعم"

                            }
                            },
                            {
                                title: '<?php echo e(trans('labels.created_at')); ?>',
                                data: 'created_at',
                                name: 'created_at',
                            },
                            {
                                title: '<?php echo e(trans('labels.updated_at')); ?>',
                                data: 'updated_at',
                                name: 'updated_at',
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
    <?php $controler = 'bouquets.changeOrder' ?>
    <?php echo $__env->make('admin.sortFiles.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/bouquets/index2.blade.php ENDPATH**/ ?>