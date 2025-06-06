<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'surname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'registration_key_id' => ['required', 'exists:registration_keys,id']
        ]);

        $user = User::create([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'registration_key_id' => $request->registration_key_id,
            'is_mail_confirmed' => false
        ]);

        $user->sendVerificationKey();

        Auth::login($user);

        return response()->json([
            'message' => 'User registered. Verification code sent to email'
        ]);
    }
}
