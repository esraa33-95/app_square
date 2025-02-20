<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\User\LoginRequest;
use App\Http\Requests\Api\Front\User\RegisterRequest;
use App\Http\Traits\Response;
use App\Services\Front\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use Response;
    
    public function __construct(private AuthService $authService) {
    }
    //task1
    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->validated());
        
        return $this->responseApi(__('successfully register'));
    }

   
    //task1
  public function login(LoginRequest $request)
  {
    $data = $this->authService->login($request->validated());
    return $data;
   
  }

  //task1
  public function logout()
{
  $data = $this->authService->logout();

  return $this->responseApi(__('user logout successfully'),$data);
}

//forgetpassword

public function sendResetLink(Request $request)
{
   set_time_limit(300);

    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'message' => $validator->errors()], 422);
    }

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? response()->json(['status' => true, 'message' => 'Password reset link sent to your email.'])
        : response()->json(['status' => false, 'message' => 'Unable to send reset link.'], 500);
}



}