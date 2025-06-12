<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UserTotalScore;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTotalScoreController extends Controller
{
    /**
     * Get the global leaderboard for the 30 users with the highest score and the position of the current user.
     *
     * @param Request $request The incoming HTTP request
     * @return JsonResponse A JSON response containing the leaderboard .
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $userScore = UserTotalScore::where('user_id', $userId)
            ->value('total_score');

        $userRank = is_null($userScore)
            ? null
            : UserTotalScore::where('total_score', '>', $userScore)->count() + 1;

        $users = UserTotalScore::orderByDesc('total_score')
            ->limit(30)
            ->get();

        if ($users->isEmpty()) {
            return response()->noContent();
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'ranking' => $users,
                'user_ranking' => $userRank
            ],
        ], 200);
    }

    /**
     * Get the market's leaderboard for the 30 users with the highest score and the position of the current user.
     *
     * @param Request $request The incoming HTTP request
     * @param int $marketId The id of the targeted market
     * @return JsonResponse A JSON response containing the leaderboard .
     */
    public function showByMarket(Request $request): JsonResponse
    {
        $user = $request->user();

        $marketId = $user->registrationKey?->store?->market?->id;

        if (!$marketId) {
            return response()->noContent();
        }

        $userScore = UserTotalScore::where('user_id', $user->id)
            ->where('market_id', $marketId)
            ->value('total_score');

        $userRank = is_null($userScore)
            ? null
            : UserTotalScore::where('market_id', $marketId)
                ->where('total_score', '>', $userScore)
                ->count() + 1;

        $users = UserTotalScore::where('market_id', $marketId)
            ->orderByDesc('total_score')
            ->limit(30)
            ->get();

        if ($users->isEmpty()) {
            return response()->noContent();
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'ranking' => $users,
                'user_ranking' => $userRank
            ]
        ], 200);
    }

    /**
     * Get the score of the current user.
     *
     * @return JsonResponse A JSON response containing the score .
     */
    public function showOwnScore(): JsonResponse
    {
        $user = auth()->user();

        $score = UserTotalScore::where('user_id', $user->id)
            ->sum('total_score');
        
        return response()->json([
            'status' => 'success',
            'data' => $score
        ], 200);
    }
}