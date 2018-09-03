<?php

namespace Fuindy\Repositories\Account\v1\Logics\Users;

use Illuminate\Http\Request;

abstract class UserAuthUseCase
{
    public static function login(Request $request)
    {
        return (new static)->handleLogin($request);
    }

    abstract public function handleLogin($request);

    public static function refresh(Request $request)
    {
        return (new static)->handleRefresh($request);
    }

    abstract public function handleRefresh($request);

    public static function loginSuccessful()
    {
        return (new static)->handleLoginSuccessful();
    }

    abstract public function handleLoginSuccessful();

    public static function logout(Request $request)
    {
        return (new static)->handleLogout($request);
    }

    abstract public function handleLogout($request);
}