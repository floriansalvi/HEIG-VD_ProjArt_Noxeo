<?php

use App\Http\Controllers\Api\v1\RegistrationKeyController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\GameProgressController;
use App\Http\Controllers\Api\v1\GameQuestionProgressController;
use App\Http\Controllers\Api\v1\ModuleController;
use App\Http\Controllers\Api\v1\StepController;
use App\Http\Controllers\Api\v1\TestController;
use App\Http\Controllers\Api\v1\TestProgressController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\v1\UserTotalScoreController;
use App\Http\Controllers\Api\v1\BadgeController;
use App\Http\Controllers\Api\v1\VerificationController;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {

    // Verifify the registration key submitted by user
    Route::get('/registration-key/{key}', [RegistrationKeyController::class, 'show']);

    // Protect the Routes with a middleware
    Route::middleware('auth:sanctum')->group(function () {

        // Check the verification key submitted by the user
        Route::post('/user/verify', [VerificationController::class, 'verifyEmail']);

        // Update the user password
        Route::put('/user/update-password', [UserController::class, 'updatePassword']);

        // Update the user profile data
        Route::put('/user/update-profile', [UserController::class, 'updateProfile']);

        // Delete the user account
        Route::delete('/user/delete', [UserController::class, 'destroy']);

        // Send a new verification key
        Route::post('/user/verify/resend', [VerificationController::class, 'resendVerificationKey']);


        // Get the global leaderboard and position of current user
        Route::get('/leaderboard', [UserTotalScoreController::class, 'index']);

        // Get the market's leaderboard and position of current user
        Route::get('/leaderboard/market', [UserTotalScoreController::class, 'showByMarket']);

        // Get the score of the logged in user
        Route::get('user/score', [UserTotalScoreController::class, 'showOwnScore']);

        // Get all categories and their modules
        Route::get('/categories', [CategoryController::class, 'index']);

        // Get a specific category and its modules
        Route::get('/categories/{categoryId}', [CategoryController::class, 'show']);


        // Get a specific module and its learning blocks
        Route::get('/modules/{moduleId}/learning', [ModuleController::class, 'showLearningByModuleId']);

        // Get a specific module and its steps
        Route::get('/modules/{moduleId}/steps', [ModuleController::class, 'showStepsByModuleId']);


        // Get all badges
        Route::get('/badges', [BadgeController::class, 'index']);

        // Get the badges owned by a specific user
        Route::get('user/badges', [BadgeController::class, 'showByUser']);


        // Get a specific test and its test_questions and their choices + choiceables
        Route::get('/tests/{testId}', [TestController::class, 'show']);


        // Get a step and its child
        Route::get('/steps/{stepId}', [StepController::class, 'show']);


        // Get the gameProgress for a specific game and user
        Route::get('/game-progress/{gameId}', [GameProgressController::class, 'show']);

        // Save a progress or update if already exists
        Route::post('/game-progress', [GameProgressController::class, 'store']);


        // Get the testProgress for a specific test and user
        Route::get('/test-progress/{testId}', [TestProgressController::class, 'show']);

        // Save a progress or update if already exists
        Route::post('/test-progress', [TestProgressController::class, 'store']);


        // Get the gameQuestionProgress for a specific gameQuestion, gameProgress and user
        Route::get('/game-question-progress/{gameProgressId}/{gameQuestionId}', [GameQuestionProgressController::class, 'show']);

        // Save a progress or update if already exists
        Route::post('/game-question-progress', [GameQuestionProgressController::class, 'store']);
    });
});