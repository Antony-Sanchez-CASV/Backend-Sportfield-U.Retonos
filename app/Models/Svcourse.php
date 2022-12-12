<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Svcourse extends Model
{
    static $rules = [
		'id_vcourse' => 'required',
		'id_schedule' => 'required',
		'quotaAvalible' => 'required',

    ];
    protected $table = "svcourses";
    protected $fillable =
        [
            "id",
            "id_vcourse",
            "id_schedule",
            "quotaAvalible",
        ];
    use HasFactory;
    public function vcourses()
    {
        return $this->belongsToMany(Vcourse::class)->withTimestamps();
    }
    public function schedules()
    {
        return $this->belongsToMany(Schedule ::class)->withTimestamps();
    }
    public function getHours(){
        $sch=Schedule::where('id',$this->id_schedule)->first();
        return $sch->gethour();
    }
    public function getDays(){
        $sch=Schedule::where('id',$this->id_schedule)->first();
        return $sch->getDayName();
    }
}
