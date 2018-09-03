<?php

namespace Fuindy\Http\Requests\v1\Student;

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
            'id' => '',
            'customer_id' => '',
            'school_id' => 'required',
            'department_id' => 'required',
            'religion_id' => 'required',
            'full_name' => 'required',
            'NISN' => 'required',
            'email' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'phone_no' => 'required',
            'hobby' => 'required',
            'purpose' => 'required',
            'address' => 'required',
            'stay_with' => 'required',
            'distance_to_school' => 'required',
            'name_of_previous_school' => 'required',
            'previous_school_address' => 'required',
            'graduate_to_school' => 'required',
//            'image' => 'required',
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
            'trustee_name' => '',
            'trustee_occupation' => '',
            'trustee_place_birth' => '',
            'trustee_date_birth' => '',
            'trustee_income' => '',
            'status_registration_id' => 'required',
            'date_registration' => 'required',
        ];
    }
}
