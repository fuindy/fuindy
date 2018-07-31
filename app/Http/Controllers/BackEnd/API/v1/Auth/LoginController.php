<?php

namespace App\Http\Controllers\BackEnd\API\v1\Auth;

use App\Http\Controllers\BackEnd\API\v1\Traits\IssueTokenTrait;
use App\Repositories\Account\v1\Logics\Users\UserAuthLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {
        return UserAuthLogic::login($request);
    }

    public function refresh(Request $request)
    {
        return UserAuthLogic::refresh($request);
    }

    public function loginSuccessful()
    {
        return UserAuthLogic::loginSuccessful();
    }

    public function logout(Request $request)
    {
        return UserAuthLogic::logout($request);
    }
}
