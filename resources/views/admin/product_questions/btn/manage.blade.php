<td>
    @if( $question_status == 0)
{{--    @if($reviews_read == 0 and $question_status == 0)--}}
        <a class="btn btn-warning"
           style="width: 100%;  margin-bottom: 5px;"
           href="{{ URL::to('admin/product_questions/edit/'.$product_question_id.'/0')}}">{{ trans('labels.pending') }}</a>
        </br>
    @endif
    <a class="btn btn-success"
       style="width: 100%;  margin-bottom: 5px;"
       href="{{ URL::to('admin/product_questions/edit/'.$product_question_id.'/1')}}">{{ trans('labels.Active') }}</a>
    </br>
    <a class="btn btn-info"
       style="width: 100%;  margin-bottom: 5px;"
       href="{{ URL::to('admin/product_questions/show/'.$product_question_id)}}">{{ trans('labels.Replay') }}</a>
    </br>
    <a class="btn btn-danger"
       style="width: 100%;  margin-bottom: 5px;"
       href="{{ URL::to('admin/product_questions/edit/'.$product_question_id.'/-1')}}">{{ trans('labels.Deactive') }}</a>
</td>
