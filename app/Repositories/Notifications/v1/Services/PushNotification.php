<?php

namespace Fuindy\Repositories\Notifications\v1\Services;

use Fuindy\Events\TestBroadcast;
use Fuindy\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use Fuindy\Repositories\Account\v1\Models\User;
use Fuindy\Repositories\Components\v1\Models\Religion;
use Fuindy\Repositories\Notifications\v1\Models\Notification;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Fuindy\Traits\v1\Globals\ResponseCodes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PushNotification
{
    use GlobalUtils;

    public function __construct()
    {
    }

    public function notify($data = array())
    {
        try {

            if ($data['groupNotify'] && $data['sender'] && $data['message'] &&
                $data['title'] && $data['userId'] && $data['viaType']
            ) {

                $user = User::find($data['userId']);
                $customer = $user->customer;

                if ($customer) {

                    $notification = Notification::create([
                        'group_id' => $data['groupNotify'],
                        'user_id' => $data['userId'],
                        'title' => $data['title'],
                        'message' => $data['message'],
                        'intent_type' => $data['intentType'],
                        'via_type' => $data['viaType'],
                        'group_type_id' => $data['notifyGroupType'],
                        'url' => $data['url'],
                        'send_by' => $this->checkNullValueDataCustomerNo1($data['sender'], 'customer', 'full_name'),
                        'send_date' => Carbon::now()->format('d/m/Y'),
                        'send_time' => Carbon::now()->format('H:i'),
                    ]);

                    if ($data['viaType'] == GlobalComponentCode::$NOTIFY_TYPE['NOTIFICATION']) {

                        if ($notification) {

                            //EVENT BROADCAST ECHO (FOR WEB)
                            broadcast(new TestBroadcast($customer->id, $notification->id))->toOthers();
                        }
                    }

                }

            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}