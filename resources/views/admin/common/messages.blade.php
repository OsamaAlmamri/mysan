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

                @if(session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible text-center btn-block mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check mr-2"></i>{{ session('danger') }}
                    </div>
                @endif
                @if(session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible text-center btn-block mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check mr-2"></i>{{ session('warning') }}
                    </div>
                @endif

        </div>
    </div>

</div>
