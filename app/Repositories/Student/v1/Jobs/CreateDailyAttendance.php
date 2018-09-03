<?php

namespace Fuindy\Repositories\Student\v1\Jobs;

use Fuindy\Repositories\School\v1\Models\AttendanceSchoolSetting;
use Fuindy\Repositories\Student\v1\Models\AttendanceStudent;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;

class CreateDailyAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GlobalUtils;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $students = Student::where('status_student_id', GlobalComponentCode::$STATUS_STUDENT['STUDENT'])->get();

        if ($students) {

            foreach ($students as $student) {

                $attendanceSetting = AttendanceSchoolSetting::where('school_id', $student->school_id)
                    ->orWhereNull('school_id')
                    ->orderBy('id', 'DESC')
                    ->first(['value']);

                if ($attendanceSetting) {

                    for ($a = 0; $a < $attendanceSetting->value; $a++) {

                        AttendanceStudent::create([
                            'school_id' => $student->school_id,
                            'student_id' => $student->id,
                            'student_class_id' => $student->student_class_id,
                            'date' => Carbon::now()->format('d/m/Y'),
                            'hour_study' => ($a + 1)
                        ]);

                    }

                }
            }
        }

    }

}
