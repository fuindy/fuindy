<?php

namespace Fuindy\Traits\v1\Globals;

class GlobalComponentCode
{

    /*
     |-------------------------------------------------------------------------
     | Types Configurations
     |--------------------------------------------------------------------------
   */

    public static $FCM_INTENT_TYPE = [
        'DEFAULT' => 'home',
        'HOME' => 'home',
        'TEACHER' => 'teacher',
        'STUDENT' => 'student',
        'SCHOOL' => 'school'
    ];

    public static $GROUP_CUSTOMER = [
        'ADMIN' => 1,
        'SCHOOL' => 2,
        'STUDENT' => 3,
        'TEACHER' => 4,
        'VISITOR' => 5
    ];

    public static $GROUP_QUESTION = [
        'REGISTRATION_STUDENT' => 1,
        'EXERCISE_STUDENT' => 2,
        'EXAM_STUDENT' => 3
    ];

    public static $GROUP_NOTIFICATION = [
        'CHATTING' => 1,
        'REGISTRATION_STUDENT' => 2,
        'QUESTION' => 3
    ];

    public static $GROUP_ORGANISATION_CLASS = [
        'MEMBER' => 0,
        'CHAIRMAN' => 1,
        'VICE_CHAIRMAN' => 2,
        'SECRETARY' => 3,
        'VICE_SECRETARY' => 4,
        'TREASURER' => 5,
        'VICE_TREASURE' => 6,
        'SECTION_OF_CLEANLINESS' => 7,
        'SECTION_OF_SAFETY' => 8,
        'SECTION_OF_NEATNESS' => 9,
        'SECTION_OF_RELIGIOUS' => 10,
        'SECTION_OF_SPORT' => 11
    ];

    public static $GROUP_ORGANISATION_SCHOOL = [
        'MEMBER' => 0,
        'CHAIRMAN' => 1,
        'VICE_CHAIRMAN' => 2,
        'SECRETARY' => 3,
        'VICE_SECRETARY' => 4,
        'TREASURER' => 5,
        'VICE_TREASURE' => 6,
        'PUBLIC_RELATIONS' => 7,
        'SECTION_OF_CLEANLINESS' => 8,
        'SECTION_OF_SAFETY' => 9,
        'SECTION_OF_NEATNESS' => 10,
        'SECTION_OF_RELIGIOUS' => 11,
        'SECTION_OF_SPORT' => 12
    ];

    public static $GROUP_ORGANISATION_TEACHER = [
        'HOMEROOM_TEACHER' => 1,
        'ADVISER_OSIS' => 2,
        'ADVISER_SCOUT' => 3,
        'ADVISER_MUSIC' => 3
    ];

    public static $NOTIFICATION_GROUP_TYPE = [
        'GENERAL' => 1,
        'ADD_QUESTION' => 2,
        'ANSWER' => 3,
        'CHATTING' => 4,
        'STORY' => 5,
    ];

    public static $IS_DELETED = [
        'FALSE' => 0,
        'TRUE' => 1
    ];

    public static $NOTIFY_TYPE = [
        'NOTIFICATION' => 'notification',
        'SMS' => 'sms'
    ];

    public static $STATUS_ACTIVE = [
        'ACTIVE' => 1,
        'INACTIVE' => 2,
        'BLOCK' => 3
    ];

    public static $STATUS_QUESTION_TEST = [
        'UPLOAD' => 1,
        'FINISH' => 2,
        'READ' => 3
    ];

    public static $STATUS_REGISTRATION_TEST = [
        'PROCESSED' => 1,
        'BE_READ' => 2,
        'NOT_COMPLETE' => 3,
        'COMPLETE' => 4,
        'BE_ACCEPTED' => 5,
        'NOT_ACCEPTED' => 6
    ];

    public static $STATUS_STUDENT = [
        'STUDENT' => 1,
        'ALUMNI' => 2,
        'SUSPEND' => 3,
        'APPRENTICESHIP' => 4,
        'DO' => 5
    ];

    public static $STATUS_TEACHER = [
        'SENIOR' => 1,
        'JUNIOR' => 2,
        'PENSION' => 3,
        'LEAVE' => 4,
        'HONORARIUM' => 5,
        'RESIGN' => 6
    ];

    public static $TYPE_QUESTION = [
        'REGISTRATION' => 1,
        'STUDENT' => 2
    ];


    /*
      |-------------------------------------------------------------------------
      | Paths Configurations
      |--------------------------------------------------------------------------
    */
}