<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'main_project_id' => 'nullable|exists:projects,id',
        ];
    }
}
