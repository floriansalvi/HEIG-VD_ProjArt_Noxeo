<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameProgressRequest;
use App\Models\GameProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameProgressController extends Controller
{
    /**
     * Store a gameProgress for a specific game and user
     *
     * @param GameProgressRequest $request The FormRequest containing the data to store
     * @return JsonResponse A JSON response containing the progress.
     */
    public function store(GameProgressRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $progress = GameProgress::where('user_id', $user->id)
            ->where('game_id', $data['game_id'])
            ->first();

        if ($progress) {
            return $this->update($progress, $data);
        }

        $progress = GameProgress::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 201);
    }

    /**
     * Update a gameProgress for a specific game and user
     *
     * @param GameProgress $progress The progress to update
     * @param array $data The new progress data
     * @return JsonResponse A JSON response containing the progress.
     */
    private function update(GameProgress $progress, array $data): JsonResponse
    {
        $progress->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }

    /**
     * Get a gameProgress for a specific user and game
     *
     * @param int $gameId The id of the targeted game
     * @return JsonResponse A JSON response containing the progress.
     */
    public function show(int $gameId): JsonResponse
    {
        $user = auth()->user();

        $progress = GameProgress::where('user_id', $user->id)
            ->where('game_id', $gameId)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }
}