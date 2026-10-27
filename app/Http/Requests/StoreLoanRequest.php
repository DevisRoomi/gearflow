<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'gear_ids' => 'required|array|min:1',
            'gear_ids.*' => 'exists:gears,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'purpose' => 'required|string|min:5|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'gear_ids.required' => 'Pilih minimal satu alat inventaris dari rak.',
            'purpose.min' => 'Jelaskan keperluan peminjaman minimal 5 karakter.',
            'due_date.after_or_equal' => 'Tanggal kembali tidak boleh lebih awal dari tanggal pinjam.',
        ];
    }
}
