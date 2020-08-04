<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;"
       href="{{route('bouquets.edit', $bouquet_id )}}">{{ trans('labels.EditProduct') }}</a>
    <br>

    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;"
       href="{{url('admin/products/images/display/'. $bouquet_id) }}">{{ trans('labels.ProductImages') }}</a>
    <br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId"
       products_id="{{ $bouquet_id }}">{{ trans('labels.DeleteProduct') }}</a>
</td>
