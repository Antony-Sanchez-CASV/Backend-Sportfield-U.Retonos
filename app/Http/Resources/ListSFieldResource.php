<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SsfieldResource;

class ListSFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id_field'=>$this->id,
            'name_field'=>$this->code_s_field,
            'sector'=>$this->getSector(),
            'activity'=>$this->getActivity(),
            'schedules'=>SsfieldResource::collection($this->ssfields),
        ];
    }
}
