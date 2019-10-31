<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotation extends FormRequest
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
            'company_id'=>'required|exists:companies,id',
            'no'=>'required|string|max:20',
            'title'=>'required|string|max:100',
            'terms'=>'nullable|string',
            'description'=>'nullable|string',
        ];
    }
}
