<a data-id="{{$id}}"
        data-status="{{$categories_status}}"
        class="active"
>
    @if($categories_status==1)
{{--        enabled--}}
        <i class="fa fa-eye"> </i>
    @else
{{--        disabled--}}
        <i class="fa fa-eye-slash"> </i>
    @endif
</a>
