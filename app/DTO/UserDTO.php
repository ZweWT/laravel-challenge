<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\LoginRequest;

class UserDTO extends DataTransferObject
{
    public string $email;
    public string $password;

    public static function fromRequest(LoginRequest $request)
    {
        return new self([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }
}