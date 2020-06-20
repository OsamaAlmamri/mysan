<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Web\AlertController;
use App\Models\API\Cart;
use App\Models\API\Currency;
use App\Models\API\Customer;
use App\Models\API\Index;
use App\Models\API\Languages;
use App\Models\API\Products;
use App\Rules\MatchOldPassword;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Lang;
use Session;
use Socialite;
use Validator;
use Hash;

class CustomersController extends BaseAPIController
{

    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Customer $customer,
        Cart $cart
    )
    {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->customer = $customer;
        $this->cart = $cart;
    }


    public function updateMyProfile(Request $request)
    {
        $rules = [];
        $rules['username'] = ['string', Rule::unique('users', 'username')->ignore(auth()->user()->id)];
        $rules['firstname'] = 'required|string';
        $rules['gender'] = 'required';
        $rules['lastname'] = 'required|string';
        $rules['email'] = ['string', 'email', Rule::unique('users', 'email')->ignore(auth()->user()->id)];
        $rules['phone'] = ['required', 'string', Rule::unique('users', 'phone')->ignore(auth()->user()->id)];
        $validator = Validator::make($request->all(), $rules,
            [
                'gender.required' => 'الجنس',
                'username.required' => 'إسم المستخدم مطلوب',
                'username.unique' => 'إسم المستخدم هذا مستخدم من قبل',
                'firstname.required' => 'الإسم الاول مطلوب',
                'lastname.required' => 'الإسم الاخير مطلوب',
                'email.required' => 'الإيميل مطلوب',
                'email.email' => 'صيغة الإيميل غير صالحة',
                'email.unique' => 'هذا الإيميل مستخدم بالفعل',
                'phone.unique' => 'رقم الهاتف مستخدم من قبل',
                'phone_number.required' => 'رقم الهاتف مطلوب',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
                'avatar2.image' => 'ملف الصورة غير صالح',
                'avatar2.max' => 'حجم الصورة يجب ألا يزيد عن 5 ميجابيت',
            ]);
        if ($validator->fails()) {
//            return response()->json([
//                'errors' => $validator->errors(),
//            ], 422);
            return $this->sendError($validator->errors(),'خطاء في الببينات المطلوبة',422);

        }
        $message = $this->customer->updateMyProfile($request);
        return$this->sendResponse(1,$message);

    }


    public function changeProfile_infoAPI(Request $request)
    {

        $user = auth()->user();
        $user->update($request->all());

        return response()->json(['message' => 'تم   تحديث المعلومات  بنجاح ', 'status' => 'success'], 200);
    }


    public function updateMyPassword(Request $request)
    {
        $password = auth()->user()->password;
        if (Hash::check($request->current_password, $password)) {
            $message = $this->customer->updateMyPassword($request);
            return $this->sendResponse(1, $message);
        } else {
            return $this->sendResponse(0, lang::get("website.Current password is invalid"));
        }
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleSocialLoginCallback($social)
    {
        $result = $this->customer->handleSocialLoginCallback($social);
        if (!empty($result)) {
            return redirect()->intended('/')->with('result', $result);
        }
    }

    public function createRandomPassword()
    {
        $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $pass;
    }

    public function likeMyProduct(Request $request)
    {
        $cartResponse = $this->customer->likeMyProduct($request);
        return $cartResponse;
    }


    public function wishlist(Request $request)
    {
        $result = $this->customer->wishlist($request);
        return $this->sendNotFormatResponse($result);
    }

    public function loadMoreWishlist(Request $request)
    {

        $limit = $request->limit;

        $data = array('page_number' => $request->page_number, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $myVar = new CartController();
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        return view("web.wishlistproducts")->with('result', $result);

    }

    public function forgotPassword()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {

            $title = array('pageTitle' => Lang::get("website.Forgot Password"));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("web.forgotpassword", ['title' => $title])->with('result', $result);
        }
    }

    public function processPassword(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));

        $password = $this->createRandomPassword();

        $email = $request->email;
        $postData = array();

        //check email exist
        $existUser = $this->customer->ExistUser($email);
        if (count($existUser) > 0) {
            $this->customer->UpdateExistUser($email, $password);
            $existUser[0]->password = $password;

            $myVar = new AlertController();
            $alertSetting = $myVar->forgotPasswordAlert($existUser);

            return redirect('login')->with('success', Lang::get("website.Password has been sent to your email address"));
        } else {
            return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
        }

    }


    public function subscribeNotification(Request $request)
    {

        $setting = $this->index->commonContent();

        /* Desktop */
        $type = 3;

        session(['device_id' => $request->device_id]);

        if (!empty(auth()->guard('customers')->user()->id)) {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'register_date' => time(),
                'update_date' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'customers_id' => auth()->guard('customers')->user()->id,
                'manufacturer' => '',
                $setting['setting'][54]->value => '1',
            );

        } else {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'register_date' => time(),
                'update_date' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'manufacturer' => '',
                $setting['setting'][54]->value => '1',
            );

        }
        $this->customer->updateDevice($request, $device_data);
        print 'success';
    }


}
