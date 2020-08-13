<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="<?php echo e(url('admin/devices/viewdevices')); ?>/<?php echo e($device_id); ?>"><?php echo e(trans('labels.SendNotification')); ?></a>
    </br>
    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="<?php echo e(route('reports.customers_basketDetail', $customers_id)); ?>"><?php echo e(trans('labels.ViewBasketDetails')); ?></a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" customers_id="<?php echo e($customers_id); ?>"><?php echo e(trans('labels.DeleteBasket')); ?></a>
</td>
<?php /**PATH F:\sites\mysan\resources\views/admin/reports/btns/manageCustomers_basket.blade.php ENDPATH**/ ?>