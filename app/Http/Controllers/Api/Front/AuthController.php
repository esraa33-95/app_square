<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\User\LoginRequest;
use App\Http\Requests\Api\Front\User\RegisterRequest;
use App\Http\Traits\Response;
use App\Services\Front\AuthService;


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





}