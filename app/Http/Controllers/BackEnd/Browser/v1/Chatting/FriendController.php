<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Chatting;

use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Teacher\v1\Models\Teacher;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    use GlobalUtils;

    public function listFriendStudent()
    {
        $customerId = $this->checkCustomerId();

        if ($customerId != null) {

            $student = Student::find($customerId);

            if ($student) {

                $friend = Student::where('school_id', $student->school_id)->paginate(50);

                if ($friend) {

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'Get data friends success';
                    $response['result'] = $this->handleListFriend($friend);

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Get data friends failed';
                    $response['result'] = $this->handleListFriend($friend);

                    return response()->json($response, 200);
                }
            } else {

                $response['isFailed'] = false;
                $response['status'] = 'not found';
                $response['message'] = 'Student not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = false;
            $response['status'] = 'not found';
            $response['message'] = 'Student not found';

            return response()->json($response, 200);
        }
    }

    public function listFriendTeacher()
    {
        $customerId = $this->checkCustomerId();

        if ($customerId != null) {

            $teacher = Teacher::find($customerId);

            if ($teacher) {

                $friend = Teacher::where('school_id', $teacher->school_id)->paginate(50);

                if ($friend) {

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'Get data friends success';
                    $response['result'] = $this->handleListFriend($friend);

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Get data friends failed';
                    $response['result'] = $this->handleListFriend($friend);

                    return response()->json($response, 200);
                }
            } else {

                $response['isFailed'] = false;
                $response['status'] = 'not found';
                $response['message'] = 'Teacher not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = false;
            $response['status'] = 'not found';
            $response['message'] = 'Teacher not found';

            return response()->json($response, 200);
        }
    }

    private function handleListFriend($friend)
    {
        $result = array();

        foreach ($friend as $data) {
            $result[] = [
                'id' => $data->id,
                'name' => $data->full_name,
                'profile' => $data->photo_profile
            ];
        }

        return $result;
    }
}
