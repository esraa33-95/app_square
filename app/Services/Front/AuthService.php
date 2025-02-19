<?php

namespace App\Services\Front;

use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Transformers\UserTransform;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\UserRegistered;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
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

        Mail::to($user->email)->send(new OtpMail($otp));

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
    $user = auth()->user();

    if ($user) {
        $user->tokens()->delete();

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
