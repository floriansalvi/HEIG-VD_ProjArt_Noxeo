<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestProgressRequest extends FormRequest
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
            'step_id' => 'required|exists:steps,id',
            'test_id' => 'required|exists:tests,id',
            'attempt_date' => 'required|date|date_equals:today',
            'score' => 'required|integer|min:0',
            'time_bonus' => 'required|integer|min:0',
            'is_successful' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'step_id.required' => 'The step id is required.',
            'step_id.exists' => 'The selected step id is invalid.',
            'test_id.required' => 'The test id is required.',
            'test_id.exists' => 'The selected test id is invalid.',
            'attempt_date.required' => 'The attempt date is required.',
            'attempt_date.date' => 'The attempt date must be a date.',
            'attempt_date.date_equals' => 'The attempt date must be today.',
            'score.required' => 'The score is required.',
            'score.integer' => 'The score must be an integer.',
            'score.min' => 'The score must be at least 0.',
            'time_bonus.required' => 'The time bonus is required.',
            'time_bonus.integer' => 'The time bonus must be an integer.',
            'time_bonus.min' => 'The time bonus must be at least 0.',
            'is_successful.required' => 'The is_successful field is required.',
            'is_successful.boolean' => 'The is_successful field must be a boolean.'
        ];
    }
}