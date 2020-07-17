{{$reviews_id}}
@if($reviews_read == 0 and $reviews_status == 0)
    <span
        class="label label-success">{{ trans('labels.new') }}</span>
@elseif($reviews_read == 1 and $reviews_status == 0)
    <span
        class="label label-info">{{ trans('labels.pending') }}</span>
@elseif($reviews_read == 1 and $reviews_status == 1)
    <span
        class="label label-primary">{{ trans('labels.seen') }}</span>
@elseif($reviews_read == 1 and $reviews_status == -1)
    <span
        class="label label-danger">{{ trans('labels.Deactive') }}</span>
@endif
