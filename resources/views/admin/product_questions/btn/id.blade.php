<td>
    {{ $product_question_id}}
    @if($question_read == 0 and $question_status == 0)
        <span
            class="label label-success">{{ trans('labels.new') }}</span>
    @elseif($question_read == 1 and $question_status == 0)
        <span
            class="label label-info">{{ trans('labels.pending') }}</span>
    @elseif($question_read == 1 and $question_status == 1)
        <span
            class="label label-primary">{{ trans('labels.seen') }}</span>
    @elseif($question_read == 1 and $question_status == -1)
        <span
            class="label label-danger">{{ trans('labels.Deactive') }}</span>
    @endif
</td>
