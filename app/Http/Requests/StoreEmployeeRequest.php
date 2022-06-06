<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'emp_first_name' => 'required|string',
            'emp_last_name' => 'required|string',
            'username' => 'required|unique:users,username|min:8|max:255|regex:/\w*$/',
            'emp_birth_date' => 'required|date|nullable|date_format:Y-m-d|before:today',
            'emp_phone' => 'required|digits:12',
            'hired_date' => 'required|date|nullable|date_format:Y-m-d|before:today',
            'emp_department' => 'required|not_in:0',
            'emp_division' => 'required|not_in:0',
            'emp_position' => 'required|not_in:0',
            'emp_address' => 'required',
            'emp_email_office' => 'required|email',
            'user_pass' => 'required',
        ];
    }
}
