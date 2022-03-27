<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildRequest extends FormRequest
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
            'ppb_item_qty' => 'required|integer',
            'ppb_item_pn' => 'required|string',
            'ppb_item_desc' => 'required|string',
            'ppb_item_currency' => 'required|integer',
            'ppb_item_price' => 'required|integer',
        ];
    }
}
