<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Visitors;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Fuindy\Repositories\Gallery\v1\Models\GalleryCustomer;
use Fuindy\Repositories\Gallery\v1\Models\GalleryCustomerFile;
use Fuindy\Repositories\School\v1\Transformers\GalleryCustomerDetailTransformer;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Teacher\v1\Models\Teacher;
use Fuindy\Traits\v1\Globals\GlobalUtils;

class GalleryCustomerLogic extends GalleryCustomerUseCae
{
    use GlobalUtils;

    public function handleListImage($type)
    {
        if ($type == 'student') {
            $customerId = Student::all()->get(['customer_id']);
        } else {
            $customerId = Teacher::all()->get(['customer_id']);
        }

        $galleries = GalleryCustomer::whereIn('customer_id', $customerId)
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
    }

    public function handleSearchImage($request, $type)
    {
        $search = $request->search;

        $customer = Customer::whereHas($type, function ($query) use ($search) {
            $query->where('full_name', 'LIKE', '%' . $search . '%');
        })->orderByRaw('RAND()')->paginate(20);

        if ($customer) {

            $galleries = GalleryCustomer::where('caption', 'LIKE', '%' . $customer->id . '%')
                ->orWhere('caption', 'LIKE', '%' . $search . '%')
                ->orderByRaw('RAND()')
                ->get();

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
}