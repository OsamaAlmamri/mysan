<div class="form-group" id="imageselected">
    <label for="name"
           class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}
        <span style="color:red;">*</span></label>
    <div class="col-sm-10 col-md-4">
        <div class="modal fade" id="Modalmanufactured" tabindex="-1"
             role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal" id="closemodal"
                                aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h3 class="modal-title text-primary"
                            id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                    </div>
                    <div class="modal-body manufacturer-image-embed">
                        <select class="image-picker show-html" name="image_id" id="select_img">
                            <option value=""></option>
                            @foreach(getAllImages() as $key=>$image)
                                <option data-img-src="{{asset($image->path)}}"
                                        class="imagedetail" data-img-alt="{{$key}}"
                                        value="{{$image->id}}"> {{$image->id}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="{{url('admin/media/add')}}" target="_blank"
                           class="btn btn-primary pull-left">{{ trans('labels.Add Image') }}</a>
                        <button type="button"
                                class="btn btn-default refresh-image">
                            <i class="fa fa-refresh"></i></button>
                        <button type="button" class="btn btn-primary" id="selected"
                                data-dismiss="modal">{{ trans('labels.Done') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="imageselected">
        @if((isset($old_image)) and  $old_image !=null)
                {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
            @else
                {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
            @endif
            <br>
            <div id="selectedthumbnail" class="selectedthumbnail col-md-5"></div>
            <div class="closimage">
                <button type="button" class="close pull-left image-close "
                        id="image-close"
                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; "
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <span class="help-block"
              style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryImageText') }}</span>
    </div>
</div>
@if((isset($old_image)) and  $old_image !=null)
    <div class="form-group">
        <label for="name" class="col-sm-2 col-md-3 control-label"></label>
        <div class="col-sm-10 col-md-4">
            <span class="help-block"
                  style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }} </span>
            <br>
            <img src="{{asset($old_image)}}" alt="" width=" 100px">
        </div>
    </div>
@endif
