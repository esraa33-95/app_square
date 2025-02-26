<?php

namespace App\Services\Front;

use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Transformers\UserTransform;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendOtp;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;


class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), 
        ]);

        $otp = rand(100000, 999999);
        VerificationCode::create([
            'code' => $otp,
            'user_id' => $user->id,
            'expired_at' => Carbon::now()->addMinute(),
        ]);
        
       //Mail::to('esraahedia33@gmail.com')->send(new SendOtp($otp));
        try {
            Mail::to('esraahedia33@gmail.com')->queue(new SendOtp($otp));
            Log::info('Email sent successfully to: esraahedia33@gmail.com');
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
        }

        return $user;
    }

    
   

public function login(array $credentials, Manager $fractal)
{
    if (!Auth::attempt($credentials)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $user = Auth::user();

    $resource = new Item($user, new UserTransform());
    $transformedUser = $fractal->createData($resource)->toArray();

   
    $token = $user->createtoken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $transformedUser,
        'token' => $token,
    ], 200);
}


public function logout(): array
{
    $user = Auth::user();

    if ($user) {
        
        $user->currentAccessToken()->delete();


        return [
            'status' => true,
            'message' => 'User logged out successfully',
            'data' => [],
        ];
    }

    return [
        'status' => false,
        'message' => 'No authenticated user found',
        'data' => [],
    ];
}


public function sendResetLink(array $data)
{
    $status = Password::sendResetLink($data);

    if ($status === Password::RESET_LINK_SENT) {
        return response()->json([
            'message' => __('Password reset link  successfully.')
        ], 200);
    } 

    return response()->json([
        'message' => __('Error sending reset link.'),
        'error' => __($status) 
    ], 400);
}



public function resetPassword(array $data)
{
    $status = Password::reset(
        $data,
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password) 
            ])->save();
        }
    );

    if ($status === Password::PASSWORD_RESET) {
        return response()->json([
            'message' => __('Password  reset successfully.')
        ], 200);
    } 

    return response()->json([
        'message' => __('Invalid '),
        'error' => __($status) 
    ], 400);
}
}
