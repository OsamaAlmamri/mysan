<td>
    @if(!empty($entry_street_address))
        {{ $entry_street_address }},
    @endif
    @if(!empty($entry_city))
        {{ $entry_city }},
    @endif
    @if(!empty($entry_state))
        {{ $zone_name }},
    @endif

    @if(!empty($countries_name))
        {{ $countries_name }}
    @endif

</td>
