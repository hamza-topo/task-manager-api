<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectMembersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'members' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'memebers.required' => 'The Members Field is Empty ! please select a memeber',
            'memebers.not_in' => 'The choosen value of memebers is invalid !',
        ];
    }
}
