<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompany extends FormRequest
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
            'name' => 'max:100',
            'phone' => 'max:30|unique:companies,phone,' . $this->company,
            'email' => 'email|unique:companies,email,' . $this->company,
            'category' => 'in:Vendor,Customer',
            'address' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }
}
