<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;

class SvcourseResource extends JsonResource
{

    public function toArray($request)
    {
        //Muestra los horarios de cursos
        return [
            'day'=>$this->getDays(),
            'time'=>$this->getHours(),
        ];
    }
}
