<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Get a module and its learning blocks
     *
     * @param int $testId The id of the targeted test
     * @return JsonResponse A JSON response containing the test and its questions and choices.
     */
    public function show(int $testId): JsonResponse
    {
        $test = Test::with([
            'testQuestions' => function ($query) {
                $query->orderBy('index');
            },
            'testQuestions.choices.choiceable'
        ])->findOrFail($testId);

        return response()->json([
            'status' => 'success',
            'data' => $test
        ], 200);
    }
}
