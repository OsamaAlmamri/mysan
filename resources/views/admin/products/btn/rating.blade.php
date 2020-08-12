<p> {{trans('labels.count_rating')}} :
    @if($count_rating==0)
    {{round($count_rating)}}
    @else
        <a href="{{route('reviews.display',$products_id)}}">
            {{round($count_rating)}}</a>
    @endif
</p>
<div class="ratingDiv">
@for($i=1;$i<6;$i++)
        <span class="fa fa-star @if(round($avg_rating)>=$i) checked @endif "></span>
    @endfor
</div>
<p> {{trans('labels.avg_rating')}} : {{round($avg_rating)}} </p>


