<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Owners;

use Fuindy\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use Fuindy\Repositories\Account\v1\Models\Customer;
use Fuindy\Repositories\Gallery\v1\Models\GalleryCustomer;
use Fuindy\Repositories\Gallery\v1\Models\GalleryCustomerFile;
use Fuindy\Repositories\School\v1\Transformers\GalleryCustomerDetailTransformer;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GalleryCustomerLogic extends GalleryCustomerUseCae
{
    use GlobalUtils;

    public function handleUploadImage($request)
    {
        $customerId = $this->handleSchoolId();

        if ($customerId != null) {

            if ($request->hasFile('fileImage') && $request->file('fileImage')->isValid()) {

                $gallery = GalleryCustomer::create([
                    'customer_id' => $customerId,
                    'caption' => $request->caption,
                    'date_upload' => Carbon::now()->format('d/m/Y H:i')
                ]);

                if ($gallery) {

                    $galleryFiles = $request->file('fileImage');

                    foreach ($galleryFiles as $galleryFile) {

                        /*Save new image*/
                        $newGalleryName = $this->getPhotoName($galleryFile, str_random(5));
                        $destinationGalleryPath = Config::$IMAGE_PATH['Gallery_IMAGE'];
                        $moveGalleryImage = $galleryFile->move($destinationGalleryPath, $newGalleryName);

                        if (!$moveGalleryImage) {

                            $response['isFailed'] = true;
                            $response['status'] = 'failed';
                            $response['message'] = 'Failed process image.';

                            return response()->json($response, 200);
                        }

                        $saveFile = GalleryCustomerFile::create([
                            'gallery_id' => $gallery->id,
                            'file' => $newGalleryName
                        ]);

                        if (!$saveFile) {

                            $response['isFailed'] = true;
                            $response['status'] = 'failed';
                            $response['message'] = 'Save file image failed';

                            return response()->json($response, 200);
                        }
                    }

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'Process upload image success';

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Process Image to server failed';

                    return response()->json($response, 200);
                }
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'invalid';
                $response['message'] = 'File image invalid';

                return response()->json();
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'School not found';

            return response()->json($response, 200);
        }
    }

    public function handleListImage()
    {
        $customerId = $this->handleSchoolId();

        if ($customerId != null) {

            $galleries = GalleryCustomer::where('customer_id', $customerId)
                ->orderBy('date_upload', 'DESC')
                ->orderBy('last_update', 'DESC')
                ->orderByRaw('RAND()')
                ->paginate(20);

            if ($galleries) {

                $result = array();
                foreach ($galleries as $gallery) {

                    $galleryFiles = GalleryCustomerFile::where('gallery_id', $gallery->id)
                        ->orderByRaw('RAND()')
                        ->get();

                    if ($galleryFiles) {

                        foreach ($galleryFiles as $galleryFile) {

                            $result[] = [
                                'id' => $galleryFile->id,
                                'file' => $galleryFile->file
                            ];
                        }
                    }
                }

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Get data Image success';
                $response['result'] = $result;

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Get data image failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'School not found';

            return response()->json($response, 200);
        }
    }

    public function handleSearchImage($request)
    {
        $customerId = $this->handleSchoolId();

        if ($customerId != null) {

            $search = $request->search;

            $customer = Customer::where('customer_id', $customerId)
                ->whereHas('student', function ($query) use ($search) {
                $query->where('full_name', 'LIKE', '%' . $search . '%');
            })->orWhereHas('teacher', function ($query) use ($search) {
                $query->where('full_name', 'LIKE', '%' . $search . '%');
            })->orderByRaw('RAND()')->paginate(50);

            if ($customer) {

                $galleries = GalleryCustomer::where('caption', 'LIKE', '%' . $customer->id . '%')
                    ->orWhere('caption', 'LIKE', '%' . $search . '%')
                    ->orderByRaw('RAND()')
                    ->paginate(20);

                if ($galleries) {

                    $result = array();
                    foreach ($galleries as $gallery) {

                        $galleryFiles = GalleryCustomerFile::where('gallery_id', $gallery->id)
                            ->orderByRaw('RAND()')
                            ->get();

                        foreach ($galleryFiles as $galleryFile) {

                            $result[] = [
                                'id' => $galleryFile->id,
                                'file' => $galleryFile->file
                            ];
                        }
                    }

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'Search that image success';
                    $response['result'] = $result;

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Second search that image failed';

                    return response()->json($response, 200);
                }
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'First search that image failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'School not found';

            return response()->json($response, 200);
        }
    }

    public function handleDetailImage($id)
    {
        $galleryFile = GalleryCustomerFile::find($id);

        if ($galleryFile) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Get image success';
            $response['result'] = fractal($galleryFile, new GalleryCustomerDetailTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'Get image failed';

            return response()->json($response, 200);
        }
    }

    public function handleDeleteDataUpload($id)
    {
        $galleryFile = GalleryCustomerFile::find($id);

        if ($galleryFile) {

            $galleryFile->delete();

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Delete image success';

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'Image not found';

            return response()->json($response, 200);
        }
    }

    private function handleSchoolId()
    {
        $schoolId = !is_null(Auth::user()->customer->id) ? Auth::user()->customer->id : null;

        return $schoolId;
    }
}