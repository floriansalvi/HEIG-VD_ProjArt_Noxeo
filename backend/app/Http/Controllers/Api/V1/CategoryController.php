<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories and their modules
     *
     * @return JsonResponse A JSON containing the categories and their modules.
     */
    public function index(): JsonResponse
    {
        $categories = Category::with([
            'modules' => function($query) {
                $query->orderBy('index');
            },
        ])->get();

        if ($categories->isEmpty()) {
            return response()->noContent();
        }

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }

    /**
     * Get a specific category and its modules
     *
     * @param int $categoryId The id of the targeted category
     * @return JsonResponse A JSON response containing the category and its modules.
     */
    public function show(int $categoryId): JsonResponse
    {
        $category = Category::with('modules')->findOrFail($categoryId);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }
}