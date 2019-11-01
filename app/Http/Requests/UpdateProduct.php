<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'code' => 'required|string|max:20|unique:products,code,'.$this->product,
            'name' => 'required|string|max:100',
            'stock' => 'nullable|integer',
            'company_id' => 'required|string|exists:companies,id',
            'weight' => 'nullable|number',
            'lead_time' => 'nullable|numeric',
            'buy_price' => 'nullable|number',
            'sell_price' => 'nullable|number',
            'description' => 'nullable|string',
        ];
    }
}
