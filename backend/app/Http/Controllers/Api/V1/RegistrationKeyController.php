<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\RegistrationKey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationKeyController extends Controller
{
    public function show(string $key) : JsonResponse
    {
        $registrationKey = RegistrationKey::where('key', $key)
            ->with('store')
            ->firstOrFail();
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'registration_key' => $registrationKey,
                'market_id' => $registrationKey->store->market_id
            ]
            ], 200);
    }
}
