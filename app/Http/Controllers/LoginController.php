<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\DTO\UserDTO;
use App\Http\Resources\JSONAPIResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = UserDTO::fromRequest($request);

        try {
            $user = User::where('email', $validated->email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found'
            ],404);
        }
    
        if (!Hash::check($validated->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ],404);
        }

        return new JSONAPIResource($user);
    }

}
