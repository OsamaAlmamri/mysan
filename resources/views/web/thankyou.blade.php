@extends('web.layout')
@section('content')

<section class="pro-content empty-content">
  <div class="container">
      
      <div class="row">
        <div class="col-12">
            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>
                @lang('website.You have successfully place your order')
                 <a href="{{url('/orders')}}" class="btn-link"><b>@lang('website.Order page')</b></a>.
              </p>
            </div>
          </p>
        </div>
      </div>
    
  </div>  
  
  
</section> 

@endsection
