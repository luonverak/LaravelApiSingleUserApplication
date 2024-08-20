<?php
namespace App\Http\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterService
{
    public function register()
    {
        try {
            $validator = Validator::make(request()->all(), [
                "name" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required",
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $user = User::create([
                    "name" => request("name"),
                    "email" => request("email"),
                    "password" => Hash::make(request("password")),
                ]);
                if ($user) {
                    return response()->json([
                        "status" => "Completed",
                        "message" => "User create successfully"
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}