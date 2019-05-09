<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLog extends FormRequest
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
            'date' => 'required|date_format:Y-m-d|unique:logs,date,NULL,id,user_id,' . auth()->user()->id,
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
            'date.required' => 'A date is required',
            'date.date_format' => 'Date must be in the format YYYY-MM-DD',
            'date.unique' => 'You\'ve already created a log for this date.  You can edit it from your list of activity logs.',
            'steps.numeric' => 'Steps must be a valid number',
            'workout.numeric' => 'Workout minutes must be a valid number',
            'weight.numeric' => 'Weight must be a valid number',
        ];
    }
}
