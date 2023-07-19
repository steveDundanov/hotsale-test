<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationService $registrationService)
    {
        $registration = $registrationService->register($request->validated());

        if ($registration['errors']) {
            return response()->json([
                'status' => false,
                'errors' => $registration['errors']
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'status' => true,
        ]);
    }
}
