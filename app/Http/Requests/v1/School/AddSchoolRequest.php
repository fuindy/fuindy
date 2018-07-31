<?php

namespace App\Http\Requests\v1\School;

use Illuminate\Foundation\Http\FormRequest;

class AddSchoolRequest extends FormRequest
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
            'school_access' => 'required',
            'name' => 'required',
            'school_name' => 'required',
            'email' => 'required|unique:schools',
            'password' => 'required',
            'school_group_id' => 'required',
            'school_address' => 'required',
            'since' => 'required',
            'amount_department' => 'required',
            'amount_student' => 'required',
            'amount_teacher' => 'required',
            'description_school' => 'required',
        ];
    }
}
