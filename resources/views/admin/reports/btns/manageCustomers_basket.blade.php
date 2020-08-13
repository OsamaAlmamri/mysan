<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="{{url('admin/devices/viewdevices')}}/{{ $device_id }}">{{ trans('labels.SendNotification') }}</a>
    </br>
    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/images/display/'. $customers_id) }}">{{ trans('labels.ViewBasketDetails') }}</a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" customers_id="{{ $customers_id }}">{{ trans('labels.DeleteBasket') }}</a>
</td>
