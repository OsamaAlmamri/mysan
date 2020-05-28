	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
    @if(!empty($result['commonContent']['setting'][72]->value))
    <title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
    @else
    <title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
    @endif

    @if(!empty($result['commonContent']['setting'][86]->value))
	<link rel="icon" type="image/png" href="{{asset('').$result['commonContent']['setting'][86]->value}}">
    @endif
    <meta name="DC.title"  content="<?=stripslashes($result['commonContent']['setting'][73]->value)?>"/>
    <meta name="description" content="<?=stripslashes($result['commonContent']['setting'][75]->value)?>"/>
    <meta name="keywords" content="<?=stripslashes($result['commonContent']['setting'][74]->value)?>"/>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Core CSS Files -->
	<link rel="stylesheet" type="text/css" href="{{asset('web/css').'/'.$result['commonContent']['setting'][81]->value}}.css">
	<script src="{!! asset('web/js/app.js') !!}"></script>
	@if(Request::path() == 'checkout')
		<!--------- stripe js ------>
		<script src="https://js.stripe.com/v3/"></script>

		<link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />

		<!------- paypal ---------->
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

	@endif

    <!---- onesignal ------>
    @if($result['commonContent']['setting'][54]->value=='onesignal')
	<link rel="manifest" href="{!! asset('onesignal/manifest.json') !!}" />
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
    var OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
		  //push here
      });

	//onesignal
	OneSignal.push(["init", {
	  appId: "{{$result['commonContent']['setting'][55]->value}}",
	 // safari_web_id: oneSignalSafariWebId,
	  persistNotification: false,
	  notificationClickHandlerMatch: 'origin',
	  autoRegister: false,
	  notifyButton: {
	   enable: false
	  }
	 }]);

    </script>
    @endif

    @if(!empty($result['commonContent']['setting'][76]->value))
		<?=stripslashes($result['commonContent']['setting'][76]->value)?>
    @endif
