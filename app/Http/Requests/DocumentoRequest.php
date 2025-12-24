<?php

namespace App\Http\Requests;

use App\Models\Tcc;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $tcc = Tcc::find($this->route('tcc')->id);
        return $tcc && Gate::allows('can-edit', ['tcc' => $tcc]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tipo' => [
                'required',
            ],
            'file' => [
                'required',
                File::types(['pdf']),
            ]

        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'tipo.required' => 'Atribua o documento à um tipo',
            'file.file' => 'Um arquivo deve ser enviado',
            'file.required' => 'O arquivo não foi enviado',
            'file.mimes' => 'Apenas arquivos em pdf',
        ];
    }
}
