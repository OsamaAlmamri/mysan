<div class="box-body">
    <div class="row">
        <div class="col-xs-12">
            @if (count($errors) > 0)
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        {{$errors->first()}}
                    </div>
                @endif
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    {!! session('success') !!}
                </div>
            @endif
        </div>
    </div>

</div>
