<?php

namespace App\Http\Requests;

use App\Enums\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'status' => 'in:' . Project::PENDING . ',' . Project::IN_PROGRESS . ',' . Project::COMPLETED . ',',
            'visibility' => 'in:' . Project::PUBLIC . ',' . Project::PRIVATE,
        ];
    }

    public function messages()
    {
        /** we can use translated message __('message') */
        return [
            'name.required' => 'The Field Name is empty !',
            'status.in' => 'The Given Value for status is invalid',
            'visibility.in' => 'The Given Value for Visibility is invalid',
        ];
    }
}
