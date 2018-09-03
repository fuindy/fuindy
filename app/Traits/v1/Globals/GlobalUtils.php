<?php

namespace Fuindy\Traits\v1\Globals;

use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

trait GlobalUtils
{
    public function uuid()
    {
        return Uuid::uuid4()->toString();
    }

    public function getFileName($file)
    {
        return str_random(32) . '.' . $file->extension();
    }

    public function getPhotoName($file, $text)
    {
        return str_random(20) . str_shuffle(str_replace(' ', '', $text)) . '.' . $file->extension();
    }

    private function getUserRequest()
    {
        if (!is_null(Auth::user())) { //from helpdesk
            return Auth::user();
        } else if (!is_null(Auth::guard('api')->user())) { //from API
            return Auth::guard('api')->user();
        } else {
            return null; //empty
        }
    }

    public function checkDataElseNull($check, $result)
    {
        return !is_null($check) ? $result : null;
    }

    function checkNullValueDataCustomerNo1($data, $a, $result)
    {
        if (!is_null($data->$a->student)) {

            return $data->$a->student->$result;

        } elseif (!is_null($data->$a->teacher)) {

            return $data->$a->teacher->$result;

        } elseif (!is_null($data->$a)) {

            $customer = $data->$a;

            if (!is_null($customer)) {
                return ($customer->customer_group_id == GlobalComponentCode::$GROUP_CUSTOMER['VISITOR']) ? $data->name : '';
            } else {
                return '';
            }

        } else {

            return '';
        }

    }

    public function checkCustomerId()
    {
        $user = Auth::user();

        if ($user) {

            $schoolId = !is_null($user->school_id) ? $user->school_id : null;

            if ($schoolId != null) {

                return $schoolId;
            } else {

                $customer = !is_null($user->customer) ? $user->customer : null;

                if ($customer != null) {

                    $customerId = !is_null($customer->teacher) ? $customer->teacher_id :
                        !is_null($customer->student) ? $customer->student_id : null;

                    return $customerId;
                } else {

                    return $customer;
                }
            }
        } else {

            return null;
        }

    }

}