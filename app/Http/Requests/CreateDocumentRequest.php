<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'amount' => 'numeric|min:0.01',
            'relief_type_id' => 'required|exists:relief_types,id',
            'file' => 'required|mimes:png,jpg,jpeg,doc,docx,xlx,xls,pdf'
        ];
    }
}
