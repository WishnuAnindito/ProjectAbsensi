<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeaderRequest extends FormRequest
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
            'ppb_number' => 'required|string|unique',
            'ppb_date' => 'required|date',
            'ppb_pr_id' => 'required|integer',
            'ppb_po_id' => 'required|integer',
            'ppb_for_project' => 'required|integer',
            'ppb_location' => 'required|integer',
            'ppb_dept_req' => 'required|integer',
            'ppb_schedule' => 'required|date',
            'ppb_instruction' => 'required|string',
            'ppb_notes' => 'required|string',
            'ppb_propose_name' => 'required|integer',
            'ppb_propose_pos' => 'required|integer',
            'ppb_propose_date' => 'required|date',
            'ppb_approved_name' => 'required|integer',
            'ppb_approved_pos' => 'required|integer',
            'ppb_approved_date' => 'required|date',
            'ppb_user_name' => 'required|integer',
            'ppb_user_pos' => 'required|integer',
            'ppb_user_date' => 'required|date',
            'ppb_remarks' => 'required|string',
            'insert_user' => 'required|string',
            'insert_date' => 'required|date',
            'edit_user' => 'required|string',
            'edit_date' => 'required|datetime',
        ];
    }
}
