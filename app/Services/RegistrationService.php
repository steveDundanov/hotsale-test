<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegistrationService
{
    private array $errors = [];

    public function register(array $registrationData): array
    {
        $status = false;
        $users = Cache::get('users');

        if($this->checkEmail($registrationData['email'])) {
            $registrationData['password'] = Hash::make($registrationData['password']);
            array_pop($registrationData);
            $users[] = $registrationData;
            Cache::forever('users', $users);
            $status = true;
        }

        return [
            'status' => $status,
            'errors' => $this->errors
        ];
    }

    private function checkEmail(string $email): bool
    {
        $user = collect(Cache::get('users'))->where('email', $email)->first();

        if ($user) {
            Log::channel('registrations')->info("Email $email already taken.");
            $this->errors['email'] = 'This email already taken';
            return false;
        }

        return true;
    }
}
