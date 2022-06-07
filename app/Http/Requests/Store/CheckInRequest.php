<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
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
            'task_id' => 'required|integer',
            'abs_emp_id' => 'required|integer',
            'abs_date' => 'required|date|date_format:Y-m-d|after_or_equals:today',
            'abs_time' => 'required|date_format:H:i',
            'abs_reason' => 'required|nullable|string|max:255',
            'abs_latitude_in' => 'required|nullable|string|max:255',
            'abs_longitude_in' => 'required|nullable|string|max:255',
            'abs_address_in' => 'required|nullable|string|max:255',
            'abs_zone_region_in' => 'required|nullable|string|max:255',
            'abs_zone_time_in' => 'required|nullable|string|max:25'
        ];
    }
}
