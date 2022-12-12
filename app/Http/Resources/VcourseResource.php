<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Svcourse;
use App\Models\Instructor;
use App\Http\Resources\SvcourseResource;
use App\Http\Resources\InstructorResource;


class VcourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //este recurso regresa la informacion de los cursos
        return [
            'id_course'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'located'=>$this->getLocated(),
            'instructor'=>new InstructorResource($this->instructor),
            //'schedules'=>SvcourseResource::collection($this->svcourses),
            'duration'=>[
                'duration_week'=>(int)$this->weeks,
                'duration_mounth'=>$this->getMounth(),
            ],
            'quota'=>$this->quota(),
        ];
    }
}
