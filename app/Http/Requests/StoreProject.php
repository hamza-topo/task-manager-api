<?php

namespace App\Http\Requests;

use App\Enums\Project;
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
}
