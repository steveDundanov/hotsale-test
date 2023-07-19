<?php

namespace App\Http\Requests;

use App\Rules\HasAtRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['bail', 'required', 'string'],
            'last_name' => ['bail', 'required', 'string'],
            'email' => ['bail', 'required', new HasAtRule, 'email'],
            'password' => ['bail', 'required', 'confirmed', 'min:8'],
        ];
    }
}
