<?php

namespace App\Repositories\Account\v1\Logics\Users;

use App\Http\Controllers\BackEnd\API\v1\Traits\IssueTokenTrait;
use App\Repositories\Account\v1\Logics\Users\UserAuthUseCase;
use App\Repositories\Account\v1\Models\User;
use App\Repositories\Account\v1\Transformers\SchoolDetailTransformer;
use App\Repositories\Account\v1\Transformers\StudentDetailTransformer;
use App\Repositories\Account\v1\Transformers\TeacherDetailTransformer;
use App\Traits\v1\Globals\GlobalUtils;
use App\Traits\v1\Globals\ResponseCodes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;

class UserAuthLogic extends UserAuthUseCase
{
    use GlobalUtils;
    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function handleLogin($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response['status'] = 'failed';
            $response['code'] = ResponseCodes::$ERR_CODE['MISSING_PARAM'];
            $response['message'] = 'Missing required parameter';

            return response()->json($response);
        }

        return $this->issueToken($request, 'password');
    }

    public function handleRefresh($request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
            $response['status'] = 'error';
            $response['code'] = ResponseCodes::$ERR_CODE['MISSING_PARAM'];
            $response['message'] = 'Missing required parameter';

            return response()->json($response, 200);
        }

        return $this->issueToken($request, 'refresh_token');
    }

    public function handleLoginSuccessful()
    {
        $user = Auth::guard('api')->user();

        if ($user) {

            if ($user->status_active_id == 1) {

                if ($user->customer_id != null || $user->customer_id != "") {

                    $customer = $user->customer;

                    if (!is_null($customer->student)) {

                        $student = $customer->student;

                        $response['status'] = 'success';
                        $response['code'] = ResponseCodes::$SUCCEED_CODE['SUCCESS'];
                        $response['message'] = 'Success login student.';
                        $response['result'] = fractal($student, new StudentDetailTransformer());

                    } elseif (!is_null($customer->teacher)) {

                        $teacher = $customer->teacher;

                        $response['status'] = 'success';
                        $response['code'] = ResponseCodes::$SUCCEED_CODE['SUCCESS'];
                        $response['message'] = 'Success login teacher.';
                        $response['result'] = fractal($teacher, new TeacherDetailTransformer());

                    } else {

                        $response['status'] = 'error';
                        $response['code'] = ResponseCodes::$USER_ERR_CODE['TEACHER_STUDENT_UNREGISTERED'];
                        $response['message'] = 'Customer unregistered as teacher or student in school.';

                    }

                } elseif ($user->school_id != null || $user->school_id != "") {

                    $school = $user->school;

                    $response['status'] = 'success';
                    $response['code'] = ResponseCodes::$SUCCEED_CODE['SUCCESS'];
                    $response['message'] = 'Success Login School.';
                    $response['result'] = fractal($school, new SchoolDetailTransformer());

                } else {

                    $response['status'] = 'error';
                    $response['code'] = ResponseCodes::$USER_ERR_CODE['USER_THERE_NOT_SCHOOL_CUSTOMER'];
                    $response['message'] = 'User there\'s not in school or customer.';

                }

            } else {

                $response['status'] = 'error';
                $response['code'] = ResponseCodes::$USER_ERR_CODE['USER_INACTIVE'];
                $response['message'] = 'User\'s inactive.';

            }

        } else {

            $response['status'] = 'error';
            $response['code'] = ResponseCodes::$USER_ERR_CODE['USER_UNREGISTERED'];
            $response['message'] = 'User\'s unregistered.';

        }

        return response()->json($response, 200);
    }

    public function handleLogout($request)
    {
        $accessToken = Auth::guard('api')->user()->token();

        if ($accessToken) {
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);

            $accessToken->revoke();


            $response = array();
            $response['status'] = 'success';
            $response['code'] = ResponseCodes::$SUCCEED_CODE['SUCCESS'];
            $response['message'] = 'Logout success.';

            return response()->json($response, 200); //success response
        } else {
            $response['status'] = 'error';
            $response['code'] = ResponseCodes::$ERR_CODE['UNKNOWN'];
            $response['message'] = 'Unknown error';
            return response()->json($response, 200); //error response
        }
    }
}