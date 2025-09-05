<?php

namespace App\Http\Requests;

use App\Enums\EducationLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreCandidacyRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email'],
            'desired_role' => 'required',
            'education_level' => ['required', Rule::enum(EducationLevel::class)],
            'observations' => ['nullable', 'string'],
            'cv_file' => ['required', File::types(['doc', 'docx', 'pdf'])->max('1mb')],
            'phone' => ['required' ,'size:11'],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'O campo de nome é obrigatório.',
        'email.required' => 'O campo de e-mail é obrigatório.',
        'email.email' => 'O e-mail informado não é válido.',
        'phone.required' => 'O campo de telefone é obrigatório.',
        'phone.size' => 'O telefone deve ter exatamente 11 caracteres.',
        'desired_role.required' => 'O cargo desejado é obrigatório.',
        'education_level.required' => 'O campo de escolaridade é obrigatório.',
        'education_level' => 'A escolaridade selecionada é inválida.',
        'observations.string' => 'As observações devem ser um texto válido.',
        'cv_file.required' => 'O currículo é obrigatório.',
        'cv_file.file' => 'O currículo enviado deve ser um arquivo válido.',
        'cv_file.mimes' => 'O currículo deve ser um arquivo PDF, DOC ou DOCX.',
        'cv_file.max' => 'O currículo deve ter no máximo 1MB.',
    ];
}

}
