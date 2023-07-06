<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            abort(404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return new JsonResponse(['error' => 'Credentials are incorrect.'], 422);
        }

        $device = Str::substr($request->userAgent() ?? '', 0, 255);

        return new JsonResponse(['accessToken' => $user->createToken($device)->plainTextToken]);
    }
}
