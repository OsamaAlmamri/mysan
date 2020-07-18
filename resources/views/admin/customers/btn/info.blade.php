<td>
    <strong>{{ trans('labels.Phone') }}: </strong> {{ $phone }} <br>
    <strong>{{ trans('labels.Devices') }}: </strong>
    @if(count($devices)>0)
        <a href="javaScript:avoid(0)" id="notification-popup" customers_id="{{ $id }}">
            @foreach($devices as $devices_data)
                <span>
                                                        @if($devices_data->device_type == 1)
                        {{ trans('labels.IOS') }}
                    @elseif($devices_data->device_type == 2)
                        {{ trans('labels.Android') }}
                    @elseif($devices_data->device_type == 3)
                        {{ trans('labels.Website') }}
                    @endif
                                                    </span>
            @endforeach
        </a>
    @endif
</td>
