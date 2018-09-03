<?php

namespace Fuindy\Repositories\Student\v1\Jobs;

use Fuindy\Repositories\Student\v1\Models\AttendanceStudent;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;

class CreateAttendanceSchool implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GlobalUtils;

    public $attendanceSetting;
    public $student;
    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attendanceSetting, $student, $request)
    {
        $this->attendanceSetting = $attendanceSetting;
        $this->student = $student;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $startDate = Carbon::createFromFormat('d/m/Y', !is_null($this->request->startDate) ? $this->request->startDate : Carbon::now()->format('d/m/Y'));
        $endDate = Carbon::createFromFormat('d/m/Y', !is_null($this->request->endDate) ? $this->request->endDate : Carbon::now()->format('d/m/Y'));

        $current = strtotime($startDate);
        $last = strtotime($endDate);

        while ($current <= $last) {

            for ($a = 0; $a < $this->attendanceSetting->value; $a++) {

                foreach ($this->student as $student) {

                    AttendanceStudent::create([
                        'school_id' => $student->school_id,
                        'student_id' => $student->id,
                        'student_class_id' => $student->student_class_id,
                        'date' => date('d/m/Y', $current),
                        'hour_study' => ($a + 1)
                    ]);
                }
            }

            $current = strtotime('+1 day', $current);
        }

    }

}
