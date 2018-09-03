<?php

namespace Fuindy\Http\Controllers;

use Fuindy\Repositories\Components\v1\Models\Religion;
use Fuindy\Repositories\Student\v1\Models\StudentClass;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestingController extends Controller
{
    public function religion(Request $request)
    {
//        $religion = Religion::create([
//            'name' => $request->religion
//        ]);
//
//        if ($religion) {
//            app()->make('PushNotification')->notify([
//                'groupNotify' => GlobalComponentCode::$GROUP_NOTIFICATION['CHATTING'],
//                'userId' => Auth::user()->id,
//                'title' => 'Chatting',
//                'message' => $religion->name,
//                'intentType' => GlobalComponentCode::$FCM_INTENT_TYPE['DEFAULT'],
//                'viaType' => GlobalComponentCode::$NOTIFY_TYPE['NOTIFICATION'],
//                'notifyGroupType' => GlobalComponentCode::$NOTIFICATION_GROUP_TYPE['CHATTING'],
//                'url' => '/testing#',
//                'sender' => Auth::user(),
//            ]);
        Log::info($request);
        return response()->json($request, 200);
//        } else {
//            return response()->json('error', 200);
//        }
    }

    public function testing(Request $request)
    {
        $studentClass = StudentClass::all();

        return response()->json($studentClass);
    }
}
