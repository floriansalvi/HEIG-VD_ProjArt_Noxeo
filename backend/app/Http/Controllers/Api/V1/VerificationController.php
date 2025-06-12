<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request): JsonResponse
    {
        $request->validate([
            'key' => ['required', 'digits:6']
        ]);

        $user = auth()->user();

        $verificationKey = $user->verificationKey;

        if (!$verificationKey) {
            return response()->noContent();
        }

        if ($verificationKey->content !== $request->key) {
            return response()->noContent();
        }

        $user->is_mail_confirmed = true;
        $user->save();

        $verificationKey->delete();

        return response()->json([
            'message' => 'Email verified.'
        ]);
    }

    public function resendVerificationKey(): JsonResponse
    {
        $user = auth()->user();

        if ($user->is_mail_confirmed) {
            return response()->json([
                'message' => 'Email already verified.'
            ], 400);
        }

        $user->verificationKey()?->delete();

        $code = random_int(100000, 999999);

        $user->verificationKey()->create(['content' => $code]);

        \Mail::to($user->email)->send(new \App\Mail\VerificationKeyMail($code));

        return response()->json([
            'message' => 'A new verification code was sent to your email.'
        ]);
    }
}
