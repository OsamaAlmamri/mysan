<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResponse($result, $message)
    {
        $response = [
//            'code' => 200,
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
//            'code' => 400,
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessages)) {
            # code...
            $response['date'] = $errorMessages;
        }
        return response()->json($response, $code);

    }

//    public function index()
//    {
//        # code...
//        $books = Book::all();
//        return $this->sendResponse($books->toArray(), 'Books read succesfully');
//    }
//
//
//    public function store(Request $request)
//    {
//        # code...
//        $input = $request->all();
//        $validator =    Validator::make($input, [
//            'name'=> 'required',
//            'details'=> 'required'
//        ] );
//
//        if ($validator -> fails()) {
//            # code...
//            return $this->sendError('error validation', $validator->errors());
//        }
//
//        $book = Book::create($input);
//        return $this->sendResponse($book->toArray(), 'Book  created succesfully');
//
//    }

//    public function register(Request $request)
//    {
//        # code...
//
//        $validator =    Validator::make($request->all(), [
//            'name'=> 'required',
//            'email'=> 'required|email',
//            'password'=> 'required',
//            'c_password'=> 'required|same:password',
//        ] );
//
//        if ($validator -> fails()) {
//            # code...
//            return $this->sendError('error validation', $validator->errors());
//        }
//
//        $input = $request->all();
//        $input['password'] = bcrypt($input['password']);
//        $user = User::create($input);
//        $success['token'] = $user->createToken('MyApp')->accessToken;
//        $success['name'] = $user->name;
//
//        return $this->sendResponse($success , 'User created succesfully');
//
//    }

}
