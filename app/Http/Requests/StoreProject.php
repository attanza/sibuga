<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'company_id'=>'required|string|exists:companies,id',
            'code'=>'required|string|unique:projects',
            'title'=>'required|string|max:100',
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date',
            'amount' => 'required|numeric',
            'status'=>'required|string',
            'terms'=>'nullable|string',
            'description'=>'nullable|string',
    
        ];
    }
}
