<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestProgressRequest;
use App\Models\TestProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestProgressController extends Controller
{
    /**
     * Store a testProgress for a specific test and user
     *
     * @param TestProgressRequest $request The FormRequest containing the data to store
     * @return JsonResponse A JSON response containing the progress.
     */
    public function store(TestProgressRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $progress = TestProgress::where('user_id', $user->id)
            ->where('test_id', $data['test_id'])
            ->first();

        if ($progress) {
            return $this->update($progress, $data);
        }

        $progress = TestProgress::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 201);
    }

    /**
     * Update a testProgress for a specific test and user
     *
     * @param TestProgress $progress The progress to update
     * @param array $data The new progress data
     * @return JsonResponse A JSON response containing the progress.
     */
    private function update(TestProgress $progress, array $data): JsonResponse
    {
        $progress->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }

    /**
     * Get a testProgress for a specific user and test
     *
     * @param int $testId The id of the targeted test
     * @return JsonResponse A JSON response containing the progress.
     */
    public function show(int $testId): JsonResponse
    {
        $user = auth()->user();

        $progress = TestProgress::where('user_id', $user->id)
            ->where('test_id', $testId)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $progress
        ], 200);
    }
}
