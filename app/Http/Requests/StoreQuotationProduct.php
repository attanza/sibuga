<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationProduct extends FormRequest
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
            'quotation_id'=>'required|exists:quotations,id',
            'product_id'=>'required|exists:products,id',
            'qty'=>'required|integer',
            'price'=>'required|numeric',
            'note'=>'nullable|string',
        ];
    }
}
