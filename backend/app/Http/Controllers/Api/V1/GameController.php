<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Get a game and its questions and answers
     *
     * @param int $gameId The ID of the targeted game.
     * @return JsonResponse A JSON response containing all datas.
     */
    public function show(int $gameId): JsonResponse {
        
        $game = Game::with([
            'gameQuestions' => function($query) {
                $query->orderBy('index');
            },
            'gameQuestions.answerable'
        ])->findOrFail($gameId);

        return response()->json([
            'status' => 'success',
            'data' => $game
        ], 200);
    }
}
