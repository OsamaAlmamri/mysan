@if($id!=1)
    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/currencies/edit/'. $id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    <a id="delete" category_id="{{$id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
@else
    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/currencies/edit/'. $id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
