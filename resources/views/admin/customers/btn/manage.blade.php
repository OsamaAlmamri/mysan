<td>
    <ul class="nav table-nav">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{ trans('labels.Action') }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('admin/customers/edit') }}/{{$id}}">{{ trans('labels.EditCustomers') }}</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('admin/customers/address/display/'.$id) }}">{{ trans('labels.EditAddress') }}</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteCustomerFrom"
                                           users_id="{{ $id }}">{{ trans('labels.Delete') }}</a></li>
            </ul>
        </li>
    </ul>
</td>
