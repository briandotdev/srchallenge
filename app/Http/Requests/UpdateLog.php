<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'steps' => 'nullable|numeric',
            'workout' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'steps.numeric' => 'Steps must be a valid number',
            'workout.numeric' => 'Workout minutes must be a valid number',
            'weight.numeric' => 'Weight must be a valid number',
        ];
    }
}
