<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\School;

use App\Repositories\Components\v1\Models\GroupSchool;
use App\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use App\Repositories\Student\v1\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function getListClass()
    {
        $school = !is_null(Auth::user()->school) ? Auth::user()->school : null;

        if ($school) {

            $getClass = StudentClass::where('school_group_id', $school->school_group_id)
                ->orWhere('school_id', $school->id)
                ->get();

            if ($getClass) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Success get data';
                $response['result'] = fractal($getClass, new BasicComponentTransformer());

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status '] = 'null';
                $response['message'] = 'Data class not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'school not found';

            return response()->json($response, 200);
        }

    }

    public function getComponentClass()
    {
        $getSchoolGroup = GroupSchool::all();

        if ($getSchoolGroup) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Get data success';
            $response['result'] = fractal($getSchoolGroup, new BasicComponentTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Data not found';

            return response()->json($response, 200);
        }
    }

    public function addClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Your data request nothing empty';

            return response()->json($response, 200);
        }

        $addClass = null;
        $resultSuccess = null;
        $resultError = null;
        $schoolId = !is_null(Auth::user()->school_id) ? Auth::user()->school_id : '';

        foreach ($request->name as $nameClass) {

            $addClass = StudentClass::create([
                'school_id' => $schoolId,
                'school_group_id' => !is_null($request->school_group_id) ? $request->group_school_id : Auth::user()->school->school_group_id,
                'name' => $nameClass
            ]);

            if ($addClass) {
                $resultSuccess[] = ['id' => $addClass->id, 'name' => $addClass->name];
            } else {
                $resultError[] = ['name' => $nameClass];
            }
        }

        if ($addClass != null) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Success Add your class';
            $response['result'] = [
                'school_id' => $addClass->school_id,
                'school_group_id' => $addClass->school_group_id,
                'success' => $resultSuccess,
                'error' => $resultError
            ];

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'failed';
            $response['message'] = 'Add class failed';

            return response()->json($response, 200);
        }
    }
}
