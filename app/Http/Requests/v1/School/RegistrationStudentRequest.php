<?php

namespace App\Http\Requests\v1\School;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationStudentRequest extends FormRequest
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
            'customer_id' => 'required',
            'school_id' => 'required',
            'student_class_id' => 'required',
            'department_id' => 'required',
            'religion_id' => 'required',
            'NISN' => 'required',
            'full_name' => 'required',
            'email' => 'required|unique',
            'place_of_birth' => 'required',
            'phone_no' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'hobby' => 'required',
            'purpose' => 'required',
            'address' => 'required',
            'stay_with' => 'required',
            'distance_to_school' => 'required',
            'name_of_previous_school' => 'required',
            'previous_school_address' => 'required',
            'graduate_to_school' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_place_birth' => 'required',
            'father_date_birth' => 'required',
            'father_income' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_place_birth' => 'required',
            'mother_date_birth' => 'required',
            'mother_income' => 'required',
        ];
    }
}
