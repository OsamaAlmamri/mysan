<div class="row">
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon">{{trans('labels.MainCategories')}}</span>
            {!!Form ::select('main_categories',[],'',['class' => 'select2 form-control', 'id' => 'main_categories'])!!}
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon">{{trans('labels.Categories')}}</span>
            {!!Form ::select('subCategories',[],'',['class' => 'select2 form-control', 'id' => 'subCategories'])!!}
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group">
            <span class="input-group-addon">{{trans('labels.products')}}</span>
            {!!Form ::select('products_list',  [],'',['class' => 'select2 form-control', 'id' => 'products_list'])!!}
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class=" col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon">{{trans('labels.fromDate')}}</span>
            <input type="date" class="form-control" name="start" value="{{isset($start)?$start:''}}"
                   id="from_date">
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <span class="input-group-addon">{{trans('labels.toDate')}}</span>
            <input type="date" class="form-control" name="end" value="{{isset($end)?$end:''}}" required
                   id="to_date">
        </div>
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="input-group ">
            <button type="button" name="filter" id="filter"
                    class="btn btn-primary btn-ms waves-effect waves-light">{{trans('labels.filter')}} <i
                    class="fa fa-filter"></i></button>
        </div>
    </div>
</div>
