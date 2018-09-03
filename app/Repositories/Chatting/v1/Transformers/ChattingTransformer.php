<?php

namespace Fuindy\Repositories\Chatting\v1\Transformers;

use Fuindy\Repositories\Chatting\v1\Models\Chatting;
use Illuminate\Support\Carbon;
use League\Fractal\TransformerAbstract;

class ChattingTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Chatting $chatting)
    {
        return [
            'id' => $chatting->id,
            'content' => $chatting->content,
            'day' => $this->handleDay($chatting->create_at),
            'time' => $this->handleTime($chatting->created_at)
        ];
    }

    private function handleDay($createdAt)
    {
        $time = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->format($createdAt));

        return $time->format('H:i');
    }

    private function handleTime($createdAt)
    {
        $dateNow = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->format('Y-m-d H:i:s'));
        $dateAdd = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->format($createdAt));

        $diff = $dateNow->diffInDays($dateAdd);

        return $diff;
    }

}
