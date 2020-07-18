<td>
    <strong>{{ trans('labels.Product Type') }}:</strong>
    @if($products_type==0)
        {{ trans('labels.Simple') }}
    @elseif($products_type==1)
        {{ trans('labels.Variable') }}
    @elseif($products_type==2)
        {{ trans('labels.External') }}
    @endif
    <br>
    @if(!empty($manufacturers_name))
        <strong>{{ trans('labels.Manufacturer') }}:</strong> {{ $manufacturers_name }}<br>
    @endif
{{--    <strong>{{ trans('labels.Price') }}: </strong>     {{ getSetting()[19]->value }}{{ $products_price }}<br>--}}
    <strong>{{ trans('labels.Price') }}: </strong>    {{ $products_price }}<br>
    <strong>{{ trans('labels.Viewed') }}: </strong>  {{ $products_viewed }}<br>
    @if(!empty($specials_id))
        <strong class="badge bg-light-blue">{{ trans('labels.Special Product') }}</strong><br>
        <strong>{{ trans('labels.SpecialPrice') }}: </strong>  {{ $specials_products_price }}<br>

        @if(($specials_id) !== null)
            @php  $mytime = Carbon\Carbon::now()  @endphp
            <strong>{{ trans('labels.ExpiryDate') }}: </strong>
            @if($expires_date > $mytime->toDateTimeString())
                {{  date('d-m-Y', $expires_date) }}
            @else
                <strong class="badge bg-red">{{ trans('labels.Expired') }}</strong>
            @endif
            <br>
        @endif
    @endif
</td>
