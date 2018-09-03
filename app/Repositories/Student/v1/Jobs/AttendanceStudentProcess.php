<?php

namespace Fuindy\Repositories\Student\v1\Jobs;

use Fuindy\Repositories\Components\v1\Models\HistoryQuestion;
use Fuindy\Repositories\School\v1\Models\QuestionDetail;
use Fuindy\Repositories\Student\v1\Models\AttendanceStudent;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTest;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTestDetail;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;

class AttendanceStudentProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GlobalUtils;

    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $chairmanClass = isset(Auth::user()->customer->student) ?
                Auth::user()->customer->student->group_organisation_class_id :
                null;

            if ($chairmanClass != null || $chairmanClass == GlobalComponentCode::$GROUP_ORGANISATION_CLASS['CHAIRMAN']) {

                $attendanceStudent = AttendanceStudent::find($this->request->attendanceId);

                if ($attendanceStudent) {

                    $attendanceStudent->update([
                        'time' => Carbon::now()->format('H:i'),
                        'attend' => $this->request->attend,
                        'explanation' => $this->request->explanation
                    ]);
                }
            }
        } catch (\Exception $e) {
            //
        }
    }
}
