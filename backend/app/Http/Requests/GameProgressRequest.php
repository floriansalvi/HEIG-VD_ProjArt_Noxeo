<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameProgressRequest extends FormRequest
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
            'game_id' => 'required|exists:games,id',
            'score' => 'required|integer|min:0',
            'last_play' => 'required|date_format:Y-m-d H:i:s|before_or_equal:now',
            'is_complete' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'game_id.required' => 'The game id is required.',
            'game_id.exists' => 'The selected game id is invalid.',

            'last_play.required' => 'The last_play field is required.',
            'last_play.date_format' => 'The last_play field format must be yyyy-mm-dd hh:mm:ss',
            'last_play.before_or_equal' => 'The last_play field must not be in the future.',

            'score.required' => 'The score is required.',
            'score.integer' => 'The score must be an integer.',
            'score.min' => 'The score must be at least 0.',

            'is_complete.required' => 'The is_complete field is required.',
            'is_complete.boolean' => 'The is_complete field must be a boolean.'
        ];
    }
}
