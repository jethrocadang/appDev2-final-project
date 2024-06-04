<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'title' => ['required', 'max:255'],
                'description' => ['required'],
                'due_date' => ['required', 'date']
            ];
        } else {
            return [
                'title' => ['sometimes', 'required', 'max:255'],
                'description' => ['sometimes', 'required'],
                'due_date' => ['sometimes', 'date']

            ];
        }
    }
}
