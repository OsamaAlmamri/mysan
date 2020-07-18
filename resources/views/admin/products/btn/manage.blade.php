<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" href="{{url('admin/products/edit')}}/{{ $products_id }}">{{ trans('labels.EditProduct') }}</a>
    </br>
    @if($products_type==1)
        <a class="btn btn-info" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/attach/attribute/display')}}/{{ $products_id }}">{{ trans('labels.ProductAttributes') }}</a>

        </br>
    @endif
    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/images/display/'. $products_id) }}">{{ trans('labels.ProductImages') }}</a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="{{ $products_id }}">{{ trans('labels.DeleteProduct') }}</a>
</td>
