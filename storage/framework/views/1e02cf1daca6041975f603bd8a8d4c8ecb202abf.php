<?php $__env->startSection('header_h1'); ?>
    <h1> <?php echo e(trans('labels.Categories')); ?> <small><?php echo e(trans('labels.ListingAllMainCategories')); ?>...</small></h1>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('btn_add'); ?>
    <div class="box-tools pull-left">
        <a href="<?php echo e(URL::to('admin/categories/add')); ?>"
           type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewCategory')); ?></a>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filters'); ?>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <div class="input-group ">
                <span class="input-group-addon"><?php echo e(trans('labels.Categories')); ?></span>
                <?php echo Form ::select('subCategories',getCategoriesToSelect(),'',['class' => 'select2 form-control', 'id' => 'subCategories']); ?>

            </div>
        </div>

        <div class="col-md-4 col-xs-6">
            <div class="input-group ">
                <button type="button" name="filter" id="filter"
                        class="btn btn-primary btn-ms waves-effect waves-light"><?php echo e(trans('labels.filter')); ?> <i
                        class="fa fa-filter"></i></button>
            </div>
        </div>
    </div>
    <br>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <li class="active"><?php echo e(trans('labels.MainCategories')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <?php echo $__env->make('admin.common.active', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        
    </script>
    <script>
        $(document).ready(function () {
            var firstTime = 1;
            function load_data( sub) {
                $('#orderdata').DataTable({
                        processing: true,
                        // serverSide: true,
                        paging: true,
                        scrollX: true,
                        responsive: true,
                        searching: true,
                        language: language,
                        "createdRow": function (row, data, dataIndex) {
                            $(row).addClass('row1');
                            $(row).attr('data-id', data.id);
                            $(row).attr('width', "100%");
                        },
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
                            url: '<?php echo e(route("categories.filter2")); ?>',
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                sub: sub,

                            }
                        }
                        , columns: [
                            {
                                name: 'btn_sort',
                                data: 'btn_sort',
                                title: '<?php echo e(trans('labels.btn_sort')); ?>'
                            },
                            {
                                title: '<?php echo e(trans('labels.ID')); ?>',
                                data: 'id',
                                name: 'id',
                                orderable: false,
                                searchable: false,
                                printable: false,
                                exportable: false
                            },

                            {
                                title: '<?php echo e(trans('labels.Name')); ?>',
                                data: 'name',
                                name: 'name',
                                // 'render': function (data, type, row) {
                                //     return (data == '1') ? 'نعم ' : 'لا';
                                // }
                            },
                            {
                                title: '<?php echo e(trans('labels.Image')); ?>',
                                data: 'btn_image',
                                name: 'btn_image',
                            },

                            {
                                title: '<?php echo e(trans('labels.AddedLastModifiedDate')); ?>',
                                data: 'info',
                                name: 'info',
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


            var sub = $('#subCategories').val();
            function ChangeInput() {
                var sub = $('#subCategories').val();
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(sub);
            }

            load_data(sub);
        });
    </script>
    <?php $controler = 'categories.changeOrder' ?>
    <?php echo $__env->make('admin.sortFiles.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                </div>
                <?php echo Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')); ?>

                <div class="modal-body">
                    <p><?php echo e(trans('labels.DeleteText')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                    <button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dataTable_layaout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views/admin/categories/index2.blade.php ENDPATH**/ ?>