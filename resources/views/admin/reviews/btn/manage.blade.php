<td>
    @if($reviews_read == 0 and $reviews_status == 0)
        <a class="btn btn-warning"
           style="width: 100%;  margin-bottom: 5px;"
           href="{{ URL::to('admin/reviews/edit/'.$reviews_id.'/0')}}">{{ trans('labels.pending') }}</a>
        </br>
    @endif
    <a class="btn btn-success"
       style="width: 100%;  margin-bottom: 5px;"
       href="{{ URL::to('admin/reviews/edit/'.$reviews_id.'/1')}}">{{ trans('labels.Active') }}</a>
    </br>
    <a class="btn btn-danger"
       style="width: 100%;  margin-bottom: 5px;"
       href="{{ URL::to('admin/reviews/edit/'.$reviews_id.'/-1')}}">{{ trans('labels.Deactive') }}</a>
</td>



