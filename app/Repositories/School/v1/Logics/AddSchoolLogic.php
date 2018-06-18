<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use App\Repositories\Account\v1\Models\User;
use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Transformers\DepartmentTransformer;
use App\Repositories\School\v1\Logics\AddSchoolUseCase;
use App\Repositories\School\v1\Models\GallerySchool;
use App\Repositories\School\v1\Models\School;
use App\Traits\v1\Globals\GlobalUtils;
use App\Repositories\School\v1\Transformers\SchoolTransformer;
use Illuminate\Support\Facades\Validator;

class AddSchoolLogic extends AddSchoolUseCase
{
    use GlobalUtils;

    /*
    |--------------------------------------------------------------------------
    | Add new school
    |--------------------------------------------------------------------------
    */
    public function handleAddSchool($request)
    {
        $idSchool = $this->uuid();

        $addUser = $this->saveAddUserSchool($request, $idSchool);

        if ($addUser) {
            $addSchool = $this->saveAddSchool($request, $idSchool);

            if ($addSchool) {
                $response['status'] = 'success';
                $response['message'] = 'Add school success.';
                $response['result'] = fractal($addSchool, new SchoolTransformer());
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'Data for school is failed insert to server.';
                $response['result'] = [];
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Data for login is failed insert in to server.';
            $response['result'] = [];
        }

        return response()->json($response, 200);
    }

    private function saveAddUserSchool($request, $idSchool)
    {
        $addUser = User::create([
            'id' => $this->uuid(),
            'school_id' => $idSchool,
            'customer_id' => '',
            'admin_access' => '0',
            'school_access' => $request->school_access,
            'student_access' => '0',
            'teacher_access' => '0',
            'name' => $request->name,
            'full_name' => $request->school_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status_active_id' => '1',
            'remember_token' => str_random(10),
        ]);

        return $addUser;
    }

    private function saveAddSchool($request, $idSchool)
    {
        $addSchool = School::create([
            'id' => $idSchool,
            'school_group_id' => $request->school_iroup_id,
            'school_name' => $request->school_name,
            'email' => $request->email,
            'school_address' => $request->school_address,
            'since' => $request->since,
            'amount_department' => $request->amount_department,
            'amount_student' => $request->amount_student,
            'amount_teacher' => $request->amount_teacher,
            'description_school' => $request->description_school
        ]);

        return $addSchool;
    }

    /*
    |--------------------------------------------------------------------------
    | Add new department
    |--------------------------------------------------------------------------
    */
    public function handleAddDepartment($request)
    {
        $validator = Validator::make($request->all(),
            [
                'school_id' => 'required',
                'department_name' => 'required',
                'description_department' => 'required'
            ]
        );

        if ($validator->fails()) {
            $response['status'] = 'error';
            $response['message'] = 'Missing required content.';
            return response()->json($response, 200);
        }

        $addDepartment = Department::create([
            'id' => $this->uuid(),
            'school_id' => $request->school_id,
            'name' => $request->department_name,
            'description_department' => $request->description_department
        ]);

        if ($addDepartment) {
            $response['status'] = 'success';
            $response['message'] = 'Department success added.';
            $response['result'] = fractal($addDepartment, new DepartmentTransformer());
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Department failed added.';
            $response['result'] = [];
        }

        return response()->json($response, 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Add photo profile and photo cover school
    |--------------------------------------------------------------------------
    */
    public function handleAddPhoto($request)
    {
        $newPhotoProfileName = '';
        $newPhotoCoverName = '';
        $movePhotoProfile = '';
        $movePhotoCover = '';

        /*Handle image uploads*/
        if ($request->hasFile('photo_profile') && $request->file('photo_profile')->isValid()) {

            /*Save new image*/
            $newPhotoProfileName = $this->getPhotoName($request->photo_profile, str_random(5));
            $destinationProfilePath = Config::$IMAGE_PATH['PROFILE_IMAGE'];
            $movePhotoProfile = $request->photo_profile->move($destinationProfilePath, $newPhotoProfileName);

            if (!$movePhotoProfile) {
                $response['status'] = 'error';
                $response['message'] = 'Photo Profile can\'t save in server.';
                $response['result'] = [];
            }
        }

        /*Handle image uploads*/
        if ($request->hasFile('photo_cover') && $request->file('photo_cover')->isValid()) {

            /*Save new image*/
            $newPhotoCoverName = $this->getPhotoName($request->photo_cover, str_random(5));
            $destinationCoverPath = Config::$IMAGE_PATH['COVER_IMAGE'];
            $movePhotoCover = $request->photo_cover->move($destinationCoverPath, $newPhotoCoverName);

            if (!$movePhotoCover) {
                $response['status'] = 'error';
                $response['message'] = 'Photo Cover can\'t save in server.';
                $response['result'] = [];
            }
        }

        if ($movePhotoProfile != '' || $movePhotoCover != '') {

            $addPhoto = School::where('id', $request->school_id)
                ->update([
                    'photo_profile' => !empty($newPhotoProfileName) ? $newPhotoProfileName : '',
                    'photo_cover' => !empty($newPhotoCoverName) ? $newPhotoCoverName : ''
                ]);

            if ($addPhoto) {
                $response['status'] = 'success';
                $response['message'] = 'Photo Profile and Cover success uploaded to server.';
                $response['result'] = ['schoolId' => $request->school_id];
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Photo Profile and Cover can\'t saved.';
                $response['result'] = [];
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Photo Profile and Cover not exists.';
            $response['result'] = [];
        }

        return response()->json($response, 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Add photo gallery school
    |--------------------------------------------------------------------------
    */
    public function handleAddGallery($request)
    {
        $moveGallery = '';
        $addGallery = '';
        $resultId = [];

        /*Handle image uploads*/
        if ($request->hasFile('gallery_school') && $request->file('gallery_school')->isValid()) {

            $gallerySchools = $request->file('gallery_school');

            foreach ($gallerySchools as $gallerySchool) {

                /*Save new image*/
                $newGalleyName = $this->getPhotoName($gallerySchool, str_random(5));
                $destinationGalleryPath = Config::$IMAGE_PATH['GALLERY_IMAGE'];
                $moveGallery = $gallerySchool->move($destinationGalleryPath, $newGalleyName);

                if ($moveGallery) {
                    $addGallery = GallerySchool::create([
                        'school_id' => $request->schoolId,
                        'gallery_school' => $newGalleyName
                    ]);

                    if (!$addGallery) {
                        $resultId = [];
                    } else {
                        $resultId = $addGallery->school_id;
                    }
                }
            }

        }

        if ($moveGallery != '') {
            if ($addGallery) {
                $response['status'] = 'success';
                $response['message'] = 'Photo success uploaded.';
                $response['result'] = ['schoolId' => $resultId];
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Photo can\'t saved.';
                $response['result'] = [];
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Photo can\'t saved.';
            $response['result'] = [];
        }

        return response()->json($response, 200);
    }
}