<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Badge;

class BadgeController extends Controller
{
    /**
     * Get all badges
     *
     * @return JsonResponse A JSON response containing all badges.
     */
    public function index(): JsonResponse {
        $badges = Badge::all();

        if ($badges->isEmpty()) {
            return response()->noContent();
        }

        return response()->json([
            'status' => 'success',
            'data' => $badges
        ], 200);
    }

    /**
     * Get badges owned by the logged in user
     *
     * @return JsonResponse A JSON response containing the badges.
     */
    public function byUser(Request $request): JsonResponse {
        
        $user = $request->user();
        $badges = $user->badges()->get();

        if ($badges->isEmpty()) {
            return response()->noContent();
        }

        return response()->json([
            'status' => 'success',
            'data' => $badges
        ], 200);
    }
}
