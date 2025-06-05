<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameQuestionProgressRequest;
use App\Models\GameQuestionProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameQuestionProgressController extends Controller
{
    /**
     * Store a gameQuestionProgress for a specific gameQuestion and user
     *
     * @param GameQuestionProgressRequest $request The FormRequest containing the data to store
     * @return JsonResponse A JSON response containing the progress.
     */
    public function store(GameQuestionProgressRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $progress = GameQuestionProgress::where('user_id', $user->id)
            ->where('game_progress_id', $data['game_progress_id'])
            ->where('game_question_id', $data['game_question_id'])
            ->first();

        if ($progress) {
            return $this->update($progress, $data);
        }

        $progress = GameQuestionProgress::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 201);
    }

    /**
     * Update a gameQuestionProgress for a specific gameQuestion and user
     *
     * @param GameQuestionProgress $progress The progress to update
     * @param array $data The new progress data
     * @return JsonResponse A JSON response containing the progress.
     */
    private function update(GameQuestionProgress $progress, array $data): JsonResponse
    {
        $progress->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }

    /**
     * Get a gameQuestionProgress for a specific user and game_question
     *
     * @param int $gameQuestionId The id of the targeted question
     * @param int $gameProgressId The id of the targeted progress
     * @return JsonResponse A JSON response containing the progress.
     */
    public function show(int $gameProgressId, int $gameQuestionId): JsonResponse
    {
        $user = auth()->user();

        $progress = GameQuestionProgress::where('user_id', $user->id)
            ->where('game_progress_id', $gameProgressId)
            ->where('game_question_id', $gameQuestionId)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }
}
