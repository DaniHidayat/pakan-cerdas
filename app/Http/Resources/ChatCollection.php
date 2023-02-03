<?php

namespace App\Http\Resources;

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
                'name' => $item->fisioterapis->name,
                'address' => $item->fisioterapis->address,
                'village' => $item->fisioterapis->village,
                'district' => $item->fisioterapis->district,
                'city' => $item->fisioterapis->city,
                'province' => $item->fisioterapis->province,
                'date' => $item->date,
                'start' => $item->start,
                'end' => $item->end,
                'status' => $item->status,
            ];
        });
    }
}
