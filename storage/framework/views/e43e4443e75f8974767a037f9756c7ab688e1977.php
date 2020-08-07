<td>
    <ul class="nav table-nav">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php echo e(trans('labels.Action')); ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(url('admin/customers/edit')); ?>/<?php echo e($id); ?>"><?php echo e(trans('labels.EditCustomers')); ?></a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo e(url('admin/customers/address/display/'.$id)); ?>"><?php echo e(trans('labels.EditAddress')); ?></a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteCustomerFrom"
                                           users_id="<?php echo e($id); ?>"><?php echo e(trans('labels.Delete')); ?></a></li>
            </ul>
        </li>
    </ul>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/customers/btn/manage.blade.php ENDPATH**/ ?>