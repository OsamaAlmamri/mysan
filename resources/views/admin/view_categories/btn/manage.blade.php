<td><a data-toggle="tooltip" data-placement="bottom"
       title="{{ trans('labels.Edit') }}"
       href="{{ url('admin/view_categories/'.$id.'/edit')}}"
       class="badge bg-light-blue"><i class="fa fa-pencil-square-o"
                                      aria-hidden="true"></i></a>
    <a data-toggle="tooltip" data-placement="bottom"
       title="{{ trans('labels.Delete') }}" id="deleteCoupans_id"
       coupans_id="{{ $id }}"
       class="badge bg-red"><i class="fa fa-trash"
                               aria-hidden="true"></i></a>
</td>
