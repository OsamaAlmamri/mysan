<td>
    <a  href="{{url('admin/devices/viewdevices')}}/{{ $device_id }}"> <i  style="font-size: 20px;" class="fa fa-bell-o" aria-hidden="true"></i></a>
    <a href="{{route('reports.customers_basketDetail', $customers_id) }}"> <i  style="font-size: 20px;"  class="fa fa-eye" aria-hidden="true"></i> </a>
    <a  id="deleteProductId" customers_id="{{ $customers_id }}"><i style="font-size: 20px;"   class="fa fa-trash" aria-hidden="true"></i></a>
</td>

{{--<td>--}}
{{--    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="{{url('admin/devices/viewdevices')}}/{{ $device_id }}">{{ trans('labels.SendNotification') }}</a>--}}
{{--    </br>--}}
{{--    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="{{route('reports.customers_basketDetail', $customers_id) }}">{{ trans('labels.ViewBasketDetails') }}</a>--}}
{{--    </br>--}}
{{--    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" customers_id="{{ $customers_id }}">{{ trans('labels.DeleteBasket') }}</a>--}}
{{--</td>--}}


