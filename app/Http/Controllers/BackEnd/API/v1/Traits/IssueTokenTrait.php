<?php

namespace App\Http\Controllers\BackEnd\API\v1\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait
{
    public function issueToken(Request $request, $granType, $scope = "")
    {
        $params = [
            'grant_type' => $granType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => $scope
        ];

        $params['username'] = $request->email ? : $request->name;

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
//        return response()->json($params);
    }
}