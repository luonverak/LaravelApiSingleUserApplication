<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginService
{
    public function login()
    {
        try {

            $credentials = request(['email', 'password']);
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(
                    [
                        'status' => 'Login fail',
                        'message' => 'Try login again...'
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }
            $user = User::where("email", request("email"))->first();
            if (Hash::check(request("password"), $user->getAuthPassword())) {
                if ($user->tokens()->exists()) {
                    $user->tokens()->delete();
                }
                $token = $user->createToken("USER_TOKEN")->plainTextToken;
                $cookie = cookie("jwt", $token, 60 * 24);
                return response()->json(
                    [
                        "stutus" => "Login success",
                        "user" => $user,
                        "token" => $token,
                    ]
                )->withCookie($cookie);

            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}