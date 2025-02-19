<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VerificationCodeController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
        ]);

        $otp = rand(100000, 999999); 
        $mobile = $request->mobile;

        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $message = $twilio->messages->create(
                $mobile,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => "Your OTP code is: $otp"
                ]
            );

            return response()->json([
                'message' => 'OTP sent successfully!',
                'otp' => $otp, 
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
