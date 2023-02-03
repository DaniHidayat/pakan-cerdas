<?php

namespace App\Http\Resources\Fisioterapis;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'booking_id' => $item->booking_id,
                'name' => $item->user->name,
                'address' => $item->user->address,
                'village' => $item->user->village,
                'district' => $item->user->district,
                'city' => $item->user->city,
                'province' => $item->user->province,
                'date' => $item->date,
                'start' => $item->start,
                'end' => $item->end,
                'status' => $item->status,
            ];
        });
    }
}
