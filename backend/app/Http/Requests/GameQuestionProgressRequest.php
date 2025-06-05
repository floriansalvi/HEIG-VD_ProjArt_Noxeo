<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameQuestionProgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'game_progress_id' => 'required|exists:game_progress,id',
            'game_question_id' => 'required|exists:game_questions,id',
            'is_successful' => 'required|boolean',

        ];
    }

    public function messages(): array
    {
        return [
            'game_progress_id.required' => 'The game progress id is required.',
            'game_progress_id.exists' => 'The selected game progress id is invalid.',
            'game_question_id.required' => 'The game question id is required.',
            'game_question_id.exists' => 'The selected game question id is invalid.',
            'is_successful.required' => 'The is_successful field is required.',
            'is_successful.boolean' => 'The is_successful field must be a boolean.'
        ];
    }
}
