<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'code' => 'required|string|max:20|unique:products',
            'name' => 'required|string|max:100',
            'stock' => 'nullable|integer',
            'company_id' => 'required|string|exists:companies,id',
            'description' => 'nullable|string',
        ];
    }
}
