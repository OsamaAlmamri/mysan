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
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <?php echo session('success'); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php /**PATH F:\sites\mysan\resources\views/admin/common/messages.blade.php ENDPATH**/ ?>