<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Chatting;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Fuindy\Repositories\Chatting\v1\Models\Chatting;
use Fuindy\Repositories\Chatting\v1\Models\ChattingFriend;
use Fuindy\Repositories\Chatting\v1\Transformers\ChattingTransformer;
use Fuindy\Repositories\Chatting\v1\Transformers\ShowRoomTransformer;
use Fuindy\Repositories\Student\v1\Jobs\SendMessage;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChattingController extends Controller
{
    use GlobalUtils;

    public function listChat()
    {
        $customerId = $this->checkCustomerId();

        if ($customerId != null) {

            $chattingFriend = ChattingFriend::where('request_id', $customerId)
                ->orWhere('receiver_id', $customerId)
                ->where('is_deleted', GlobalComponentCode::$IS_DELETED['FALSE'])
                ->get();

            if ($chattingFriend) {

                $result = array();
                foreach ($chattingFriend as $data) {

                    $chatting = Chatting::where('friend_id', $data->id)
                        ->orderBy('created_at', 'DESC')
                        ->first();

                    if ($chatting) {

                        $result[] = [
                            'id' => $data->id,
                            'chatting' => $chatting-> content,
                            'friend' => $this->getDataFriend($data->receiver_id)
                        ];
                    } else {

                        $response['isFailed'] = true;
                        $response['status'] = 'failed';
                        $response['message'] = 'Get data chatting failed';

                        return response()->json($response, 200);
                    }
                }

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Get list chatting success';
                $response['result'] = $result;

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Get list chatting failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'logout';
            $response['message'] = 'You are not logged in';

            return response()->json($response, 200);
        }
    }

    public function getRoomChatting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'friendId' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Select your friend';

            return response()->json($response, 200);
        }

        $customerId = $this->checkCustomerId();

        if ($customerId != null) {

            $chattingFriend = ChattingFriend::where('request_id', $customerId)->orWhere('receiver_id', $request->friendId)->first();

            if ($chattingFriend) {

                if (count($chattingFriend) < 0) {

                    $addRoom = ChattingFriend::create([
                        'id' => $this->uuid(),
                        'request_id' => $customerId,
                        'receiver_id' => $request->friendId
                    ]);

                    if ($addRoom) {
                        $resultFriend = fractal($addRoom, new ShowRoomTransformer());
                    } else {
                        $resultFriend = array();
                    }
                } else {
                    $resultFriend = fractal($chattingFriend, new ShowRoomTransformer());
                }

                $roomId = ChattingFriend::where('request_id', $customerId)->orWhere('request_id', $request->friendId)
                    ->where('receiver_id', $customerId)->orWhere('receiver_id', $request->friendId)->get(['id']);

                $chatting = Chatting::whereIn('friend_id', $roomId)->orderBy('created_at', 'DESC')->pagination(50);

                $resultChatting = fractal($chatting, new ChattingTransformer());

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Get room chatting success';
                $response['result'] = [
                    'room' => $resultFriend,
                    'chatting' => $resultChatting
                ];

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Get room chatting failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'logout';
            $response['message'] = 'You are not logged in';

            return response()->json($response, 200);
        }
    }

    public function sendChat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'friendId' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'No data you send';

            return response()->json($response, 200);
        }

        SendMessage::dispatch($request)->onConnection('database')->onQueue('default');

        $response['isFailed'] = false;
        $response['status'] = 'success';
        $response['message'] = 'Send message success';

        return response()->json($response, 200);
    }

    public function deleteChat($id)
    {
        $chatting = Chatting::find($id);

        if ($chatting) {

            $delete = $chatting->delete();

            if ($delete) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Delete chat success';

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Delete chat failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not exist';
            $response['message'] = 'That chat you search does not exist';

            return response()->json($response, 200);
        }
    }

    public function editChat(Request $request)
    {
        $chatting = Chatting::find($request->id);

        if ($chatting) {

            $update = $chatting->update([
                'content' => $request->post('content')
            ]);

            if ($update) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Edit chat success';
                $response['result'] = fractal($update, new ChattingTransformer());

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Delete chat failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not exist';
            $response['message'] = 'That chat you search does not exist';

            return response()->json($response, 200);
        }
    }

    private function getDataFriend($receivedId)
    {
        $customer = Customer::whereHas('student', function ($query) use ($receivedId) {
            $query->find($receivedId);
        })->orWhereHas('teacher', function ($query) use ($receivedId) {
            $query->find($receivedId);
        })->first();

        if ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->full_name,
                'profile' => $customer->photo_profile
            ];
        } else {
            return array();
        }
    }
}
