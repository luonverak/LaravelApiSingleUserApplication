<?php

namespace App\Http\Controllers;

use App\Http\Service\RegisterService;
use App\Http\Service\LoginService;
use App\Http\Service\GetUserService;
use App\Http\Service\LogoutService;

class AuthController extends Controller
{
    public function register()
    {
        try {
            $register = (new RegisterService())->register();
            if ($register) {
                return $register;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function login()
    {
        try {
            $login = (new LoginService())->login();
            if ($login) {
                return $login;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getUser()
    {
        try {
            $user = (new GetUserService())->getUserService();
            if ($user) {
                return $user;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function logout()
    {
        try {
            $logout = (new LogoutService())->logout();
            if ($logout) {
                return $logout;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
