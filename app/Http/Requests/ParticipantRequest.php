<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Akan diproteksi di route/controller
        return true;
    }

    public function rules(): array
    {
        $participantId = $this->route('participant') ? $this->route('participant')->id : null;

        return [
            'participant_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('participants')->ignore($participantId)->whereNull('deleted_at'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:100'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:L,P,MALE,FEMALE'],
            'utusan_id' => ['nullable', 'exists:utusan,id'],
            'jabatan_id' => ['nullable', 'exists:positions,id'],
            'mwcnu_id' => ['nullable', 'exists:mwcnu,id'],
            'organization' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
            
            // Upload validasi
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'], // Max 2MB
            'mandate_letter' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpeg,png,jpg'], // Max 5MB
        ];
    }

    public function messages(): array
    {
        return [
            'participant_code.unique' => 'Kode peserta ini sudah digunakan.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'photo.image' => 'File foto harus berupa gambar.',
            'mandate_letter.max' => 'Ukuran surat mandat maksimal 5MB.',
        ];
    }
}
