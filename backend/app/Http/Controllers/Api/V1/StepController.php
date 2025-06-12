<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Step;

class StepController extends Controller
{
    /**
     * Return all steps sorted by category, module, and column_index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::with([
            'modules' => function ($query) {
                $query->orderBy('index')->with([
                    'steps' => function ($stepQuery) {
                        $stepQuery->orderBy('index')
                            ->with([
                                'test.testQuestions' // plus besoin de charger choices
                            ]);
                    }
                ]);
            }
        ])->orderBy('id')->get();

        foreach ($categories as $category) {
            foreach ($category->modules as $module) {
                foreach ($module->steps as $step) {
                    $step->total_points = $step->test?->testQuestions->sum('points_awarded') ?? 0;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }

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
