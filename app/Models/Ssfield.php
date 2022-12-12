<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
class Ssfield extends Model
{
    protected $table = "ssfields";
    static $rules = [
		'id_sField' => 'required',
		'id_schedule' => 'required',
		//'avalible' => 'required',
    ];
    protected $fillable = 
        [
            "id",
            "id_sField",
            "id_schedule",
            //"avalible"
        ];
    use HasFactory;
    // Relación de uno a muchos
    //un horario de prestamo tiene una cancha asignada
    public function sfields()
    {
        return $this->belongsTo(SField::class);
    }
    //un horario de prestamo tiene un horario
    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
    //funciones
    public function getSchedule(){
        $hour=Schedule::where('id',$this->id_schedule)->first();
        return [
            $hour->gethour(),
            $hour->getDay(),
        ];
    }
    public function getHours(){
        $sch=Schedule::where('id',$this->id_schedule)->first();
        return $sch->gethour();
    } 
    public function getDays(){
        $sch=Schedule::where('id',$this->id_schedule)->first();
        return $sch->getDayName();
    } 
    
    public function getAvalible(){
        $salida=$this->avalible ? 'false' : 'true';
        return $salida;
    } 
   

}
