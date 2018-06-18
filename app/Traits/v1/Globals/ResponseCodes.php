<?php

namespace App\Traits\v1\Globals;

class ResponseCodes
{

    public static $SUCCEED_CODE = [
        'SUCCESS' => 1
    ];


    public static $HTTP_CODES = [
        'SUCCESS' => 200,
        'FORBIDDEN' => 403,
        'NOT_FOUND' => 404,
        'BAD_PARAM' => 422,
        'SERVER_ERROR' => 500
    ];


    public static $ERR_CODE = [
        'UNKNOWN' => 'E001',
        'ELOQUENT_ERR' => 'E002',
        'MISSING_PARAM' => 'E003',
    ];

    public static $USER_ERR_CODE = [
        'TEACHER_STUDENT_UNREGISTERED' => 40001,
        'USER_THERE_NOT_SCHOOL_CUSTOMER' => 40002,
        'USER_INACTIVE' => 40003,
        'USER_UNREGISTERED' => 40004
    ];

    public static $PROFILE_ERR_CODE = [
        'CONFIRMATION_DOESNT_MATCH' => 70001,
        'OLD_PASSWORD_INCORRECT' => 70002
    ];

    public static $APK_ERR_CODE = [
        'APK_NOT_FOUND' => 80001
    ];

}