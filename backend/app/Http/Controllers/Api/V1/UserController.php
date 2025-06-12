<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->verificationKey()?->delete();
        $user->testProgresses()?->delete();
        $user->gameProgresses()?->delete();
        $user->gameQuestionProgresses()?->delete();
        $user->badges()->detach();

        $request->user()->currentAccessToken()?->delete();

        $user->delete();

        return response()->json([
            'message' => 'Account deleted.'
        ],200);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $user = $request->user();

        if(!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'The current password is wrong.'
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'The password was updated.'
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        $request->validate([
            'surname' => ['required', 'string', 'max:64'],
            'firstname' => ['required', 'string', 'max:64'],
            'nickname' => ['required', 'string', 'max:64', 'unique:users,nickname,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'nickname' => $request->nickname,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Profile was update',
            'user' => $user->only(['surname', 'firstname', 'nickname', 'email']),
        ]);
    }
}
