<div class="box-body">
    <div class="row">
        <div class="col-xs-12">
            <?php if(count($errors) > 0): ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>

                <?php if(session()->has('danger')): ?>
                    <div class="alert alert-danger alert-dismissible text-center btn-block mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check mr-2"></i><?php echo e(session('danger')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session()->has('warning')): ?>
                    <div class="alert alert-warning alert-dismissible text-center btn-block mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check mr-2"></i><?php echo e(session('warning')); ?>

                    </div>
                <?php endif; ?>

        </div>
    </div>

</div>
<?php /**PATH F:\sites\mysan\resources\views/admin/common/messages.blade.php ENDPATH**/ ?>