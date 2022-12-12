<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Vcourse
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $capacity
 * @property $id_instructor
 * @property $id_room
 * @property $created_at
 * @property $updated_at
 *
 * @property Instructor $instructor
 * @property Room $room
 * @property Subsvcourse[] $subsvcourses
 * @property Svcourse[] $svcourses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vcourse extends Model
{
    use  HasFactory;

    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'taken' => 'required',
		'capacity' => 'required',
		'weeks' => 'required',
		'time_mounth' => 'required',
		'id_instructor' => 'required',
		'id_room' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','taken', 'capacity','weeks','time_mounth', 'id_instructor','id_room',];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function instructor()
    {
        return $this->hasOne('App\Models\Instructor', 'id', 'id_instructor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id', 'id_room');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subsvcourses()
    {
        return $this->hasMany('App\Models\Subsvcourse', 'id_vcourse', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function svcourses()
    {
        return $this->hasMany('App\Models\Svcourse', 'id_vcourse', 'id');
    }
    public function getInstructor(){
        $instructor=Instructor::where('id',$this->id_instructor)->first();
        return "$instructor->name $instructor->latName";
    }
    public function getLocated(){
        $room=Room::where('id',$this->id_room)->first();
        return "$room->located";
    }
    public function getName(){
        return "$this->name";
    }
    public function getMounth(){
        $weeks=$this->weeks;
        $mounth=(int)($weeks/4);
        return $mounth;
    }
    public function timeWeek(){//poner las horas semanales
        $weeks=$this->weeks;
        $mounth=(int)($weeks/4);
        return $mounth;
    }
    public function quota(){
        $res=$this->capacity - $this->taken;
        return "$res";
    }
    public function avalible(){
        $res=$this->capacity - $this->taken;
        if($res>0){
            return TRUE;
        }
        return FALSE;
    }
    public function addMember(){

        $this->taken++;
        $this->save();
    }
    public function lessMember(){
        $this->taken--;
        $this->save();
    }

}
