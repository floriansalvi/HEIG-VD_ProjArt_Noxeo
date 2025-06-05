<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Step;

class StepController extends Controller
{
    /**
     * Get a step and its child
     *
     * @param int $stepId The id of the targeted step
     * @return JsonResponse A JSON response containing the test and its child.
     */
    public function show(int $stepId): JsonResponse {

        $step = Step::findOrFail($stepId);

        if ($step->type === 'game') {
            $step->load('game');
            $child = $step->game;
        } elseif ($step->type === 'test') {
            $step->load('test');
            $child = $step->test;
        } else {
            $child = null;
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'step' => $step,
                'content' => $child
            ],
        ], 200);
    }    
}
