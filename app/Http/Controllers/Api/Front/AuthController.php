<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\User\LoginRequest;
use App\Http\Requests\Api\Front\User\RegisterRequest;
use App\Http\Requests\Api\Front\User\ResetpasswordRequest;
use App\Http\Requests\Api\Front\User\SendLinkRequest;
use App\Http\Traits\Response;
use App\Services\Front\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use League\Fractal\Manager;


class AuthController extends Controller
{
    use Response;
    
    public function __construct(private AuthService $authService, private Manager $fractal) {
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
    $data = $this->authService->login($request->validated(), $this->fractal);
    return $data;
   
  }

  //task1
  public function logout()
{
  $data = $this->authService->logout();

  return $this->responseApi(__('user logout successfully'),$data);
}

//forgetpassword

public function sendResetLink(SendLinkRequest $request)
{
   $data = $request->validated();

    $data = $this->authService->sendResetLink($data);

}

//reset password

public function resetPassword(ResetpasswordRequest $request)
    {
        $data = $request->validated();

        $data = $this->authService->resetPassword($data);

      
    }

}