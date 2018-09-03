<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Visitors;

use Fuindy\Repositories\Gallery\v1\Models\GallerySchool;
use Fuindy\Repositories\Gallery\v1\Models\GallerySchoolFile;
use Fuindy\Repositories\School\v1\Transformers\GallerySchoolDetailTransformer;
use Fuindy\Traits\v1\Globals\GlobalUtils;

class GallerySchoolLogic extends GallerySchoolUseCae
{
    use GlobalUtils;

    public function handleListImage()
    {
        $galleries = GallerySchool::orderBy('date_upload', 'DESC')
            ->orderBy('last_update', 'DESC')
            ->orderByRaw('RAND()')
            ->paginate(20);

        if ($galleries) {

            $result = array();
            foreach ($galleries as $gallery) {

                $galleryFiles = GallerySchoolFile::where('gallery_id', $gallery->id)
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

    public function handleSearchImage($request)
    {
        $search = $request->search;

        $galleries = GallerySchool::where('caption', 'LIKE', '%' . $search . '%')
            ->orWhereBelongs('school', function ($query) use ($search) {
                $query->where('full_name', 'LIKE', '%' . $search . '%');
            })->orderByRaw('RAND()')->paginate(20);

        if ($galleries) {

            $result = array();
            foreach ($galleries as $gallery) {

                $galleryFiles = GallerySchoolFile::where('gallery_id', $gallery->id)
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
            $response['message'] = 'Search that image failed';

            return response()->json($response, 200);
        }
    }

    public function handleDetailImage($id)
    {
        $galleryFile = GallerySchoolFile::find($id);

        if ($galleryFile) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Get image success';
            $response['result'] = fractal($galleryFile, new GallerySchoolDetailTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'Get image failed';

            return response()->json($response, 200);
        }
    }

}