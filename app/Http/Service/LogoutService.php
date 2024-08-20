<?php
namespace App\Http\Service;

class LogoutService
{
    public function logout()
    {
        try {
            $cookie = cookie()->forget("jwt");
            request()->user()->currentAccessToken()->delete();
            if ($cookie) {
                return response()->json(
                    [
                        "status" => "Logout success",
                        "message" => "Account logout successfully"
                    ]
                )->withCookie($cookie);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}