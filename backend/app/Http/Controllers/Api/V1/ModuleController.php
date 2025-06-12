<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Get a module and its learning blocks
     *
     * @param int $moduleId The id of the targeted module
     * @return JsonResponse A JSON response containing the module, learning blocks and blockables .
     */
    public function showLearningByModuleId (int $moduleId): JsonResponse {

        $module = Module::with([
            'category',
            'learningBlocks' => function($query) {
                $query->orderBy('index');
            },
            'learningBlocks.blockable'
        ])->findOrFail($moduleId);

        return response()->json([
            'status' => 'success',
            'data' => $module
        ], 200);
    }

    /**
     * Get a module and its steps
     *
     * @param int $moduleId The id of the targeted module
     * @return JsonResponse A JSON response containing the module and its steps.
     */
    public function showStepsByModuleId (int $moduleId): JsonResponse {

        $module = Module::with([
            'steps' => function($query) {
                $query->orderBy('index');
            },
        ])->findOrFail($moduleId);

        return response()->json([
            'status' => 'success',
            'data' => $module
        ], 200);
    }
}
