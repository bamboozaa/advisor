<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMajorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'major_name' => 'required|string|max:255',
            'fac_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'major_name.required' => 'กรุณากรอกชื่อสาขาวิชา/กลุ่มวิชา',
            'fac_id.required' => 'กรุณาเลือกหลักสูตร/คณะ',
        ];
    }
}
