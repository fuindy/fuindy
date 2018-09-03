<?php

namespace Fuindy\Repositories\School\v1\Transformers;

use Fuindy\Repositories\Gallery\v1\Models\GallerySchoolFile;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Carbon;
use League\Fractal\TransformerAbstract;

class GalleryCustomerDetailTransformer extends TransformerAbstract
{
    use GlobalUtils;

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(GallerySchoolFile $gallery)
    {
        return [
            'id' => $gallery->id,
            'file' => $gallery->file,
            'caption' => $this->checkDataElseNull($gallery->gallery, $gallery->gallery->caption),
            'date' => !is_null($gallery->gallery) ? $this->handleDate($gallery->gallery) : null,
            'school' => [
                'id' => $this->checkDataElseNull($gallery->gallery, $gallery->gallery->school_id),
                'name' => $this->checkDataElseNull($gallery->gallery->school, $gallery->gallery->school->school_name),
                'description' => $this->checkDataElseNull($gallery->gallery->school, $gallery->gallery->school->description_school)
            ]
        ];
    }

    private function handleDate($gallery)
    {
        $date = !is_null($gallery->last_date) ? $gallery->last_date : $gallery->date_upload;
        $dateCarbon = Carbon::createFromFormat('d/m/Y H:i', Carbon::now()->format($date));

        $resultDate = $dateCarbon->format('l, d M Y');

        return $resultDate;
    }

}
