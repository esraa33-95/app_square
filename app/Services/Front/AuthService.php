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

    
    public function login(array $credentials)
{
    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

        $fractal = new Manager();
        $resource = new Item($user, new UserTransform());
        $transformedUser = $fractal->createData($resource)->toArray();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $transformedUser,
            'token' => $token,
        ]);
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



}
