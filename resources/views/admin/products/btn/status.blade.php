<a data-id="{{$products_id}}"
        data-status="{{$products_status}}"
        class="active"
>
    @if($products_status==1)
        <i class="fa fa-eye"> </i>
    @else
        <i class="fa fa-eye-slash"> </i>
    @endif
</a>
