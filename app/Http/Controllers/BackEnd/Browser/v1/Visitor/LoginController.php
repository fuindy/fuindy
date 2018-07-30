<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\Visitor;

use App\Repositories\Account\v1\Models\Customer;
use App\Repositories\Account\v1\Models\User;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use GlobalUtils;

    public function registrationVisitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing required data in form.';

            return response()->json($response, 200);
        }

        $user = User::create([
            'id' => $this->uuid(),
            'customer_id' => $this->uuid(),
            'admin_access' => 0,
            'school_access' => 0,
            'student_access' => 0,
            'teacher_access' => 0,
            'name' => $request->name,
            'full_name' => '-',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status_active_id' => 1,
            'remember_token' => str_random(10)
        ]);

        if ($user) {

            $customer = Customer::create([
                'id' => $user->customer_id,
                'customer_group_id' => 5
            ]);

            if ($customer) {
                $response['status'] = 'success';
                $response['message'] = 'Success registration your self';
                $response['result'] = $user;

                return response()->json($response, 200);
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Your data failed registered';

                return response()->json($response, 200);
            }

        } else {
            $response['status'] = 'error';
            $response['message'] = 'Registration failed';

            return response()->json($response, 200);
        }
    }
}
