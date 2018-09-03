<?php

namespace Fuindy\Repositories\Chatting\v1\Transformers;

use Fuindy\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use Fuindy\Repositories\Chatting\v1\Models\ChattingFriend;
use Fuindy\Repositories\School\v1\Models\School;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Teacher\v1\Models\Teacher;
use League\Fractal\TransformerAbstract;

class ShowRoomTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ChattingFriend $friend)
    {
        return [
            'id' => $friend->id,
            'friend' => $this->handleFriend($friend->receiver_id)
        ];
    }

    private function handleFriend($friend)
    {
        if (Student::find($friend)) {

            return $this->responseFriend(Student::find($friend));
        } elseif (Teacher::find($friend)) {

            return $this->responseFriend(Teacher::find($friend));
        } elseif (School::find($friend)) {

            return $this->responseFriend(School::find($friend));
        } else {

            return array();
        }
    }

    private function responseFriend($friend)
    {
        return [
            'id' => $friend->id,
            'name' => isset($friend->school_name) ? $friend->school_name : $friend->full_name,
            'status' => $this->handleStatusFriend($friend),
            'profile' => $this->handleProfile($friend)
        ];
    }

    private function handleStatusFriend($friend)
    {
        $status = [
            'id' => isset($friend->status_student_id) ? $friend->status_student_id :
                (isset($friend->status_teacher_id) ? $friend->status_teacher_id : null),
            'name' => isset($friend->status_student_id) ? (!is_null($friend->status) ? $friend->status->name : null) :
                (isset($friend->status_teacher_id) ? (!is_null($friend->status) ? $friend->status->name : null) : null)
        ];

        return $status;
    }

    private function handleProfile($friend)
    {
        $profile = !is_null($friend->photo_profile) ?
            Config::$IMAGE_PATH['PROFILE_IMAGE'] . $friend->photo_profile : null;

        return $profile;
    }
}
