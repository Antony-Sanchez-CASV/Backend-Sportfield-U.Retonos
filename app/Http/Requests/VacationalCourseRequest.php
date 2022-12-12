<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacationalCourse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => 'required|string|max:10',
		    'description' => 'required|string',
		    'capacity' => 'required|numeric|between:5,40',
		    'duration_week' => 'required|numeric|between:1,12',
		    'id_instructor' => 'required|numeric|between:1,20',
		    'id_room' => 'required|numeric|between:1,10',
        ];
    }
}
