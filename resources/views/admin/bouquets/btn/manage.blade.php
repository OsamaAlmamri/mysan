<td>
    <a class="btn btn-primary" style="width: 100%; margin-bottom: 5px;"
       href="{{route('bouquets.edit', $bouquet_id )}}">{{ trans('labels.EditBouquet') }}</a>
    <br>
{{--    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;"--}}
{{--       href="{{url('admin/products/images/display/'. $bouquet_id) }}">{{ trans('labels.ProductImages') }}</a>--}}
{{--    <br>--}}
    <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="{{route('products.images.display',['id'=>$bouquet_id,'type'=>'bouquet']) }}">{{ trans('labels.ProductImages') }}</a>
    </br>
    <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;"
       href="{{route('bouquets.delete',encrypt( $bouquet_id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');"
    >{{ trans('labels.DeleteBouquet') }}</a>
</td>
