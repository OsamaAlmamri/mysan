<td>
    <a data-toggle="tooltip" data-placement="bottom" title="View Order" href="{{ URL::to('admin/orders/vieworder')}}/ {{ $orders_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

    <a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id ="{{ $orders_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

</td>
