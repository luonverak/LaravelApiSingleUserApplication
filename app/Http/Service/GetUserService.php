<?php

namespace App\Http\Service;

class GetUserService
{
    public function getUserService()
    {
        try {
            return auth()->user();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}