<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:100|unique:contacts',
            'email' => 'required|email|unique:contacts',
            'gender' => 'required|in:Male,Female',
            'description' => 'nullable|string',
        ];
    }
}
