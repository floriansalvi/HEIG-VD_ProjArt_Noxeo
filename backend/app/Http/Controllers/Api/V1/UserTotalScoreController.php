<?php

namespace App\Http\Controllers;

use App\Models\UserTotalScore;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTotalScoreController extends Controller
{
    public function index(Request $request): JsonResponse {
        try {

            $userId = $request->user()->id;

            $userScore = UserTotalScore::where('user_id', $userId)
                ->value('total_score');

            if (is_null($userScore)) {
                $userRank = null;
            } else {
                $userRank = UserTotalScore::where('total_score', '>', $userScore)
                    ->count() + 1;
            }

            $users = UserTotalScore::orderByDesc('total_score')
                ->limit(30)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'ranking' => $users,
                    'user_ranking' => $userRank
                ],
            ], 200);

        } catch (QueryException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'A database error occured.',
                'error' => $e->getMessage()
            ], 500);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occured.',
                'error' => $e->getMessage()
            ], 500);
        } 
    }

    public function indexByMarket(Request $request, int $marketId): JsonResponse {
        try {

            $userId = $request->user()->id;

            $userScore = UserTotalScore::where('user_id', $userId)
                ->where('market_id', $marketId)
                ->value('total_score');

            if (is_null($userScore)) {
                $userRank = null;
            } else {
                $userRank = UserTotalScore::where('market_id', $marketId)
                    ->where('total_score', '>', $userScore)
                    ->count() + 1;
            }

            $users = UserTotalScore::where('market_id', $marketId)
                ->orderByDesc('total_score')
                ->limit(30)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'ranking' => $users,
                    'user_ranking' => $userRank
                ]
            ], 200);

        } catch (QueryException $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'A database error occured.',
                'error' => $e->getMessage()
            ], 500);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occured.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}