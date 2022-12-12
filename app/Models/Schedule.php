<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hour;
use App\Models\Day;
/**
 * Class Schedule
 *
 * @property $id
 * @property $id_hour
 * @property $id_day
 * @property $created_at
 * @property $updated_at
 *
 * @property Day $day
 * @property Hour $hour
 * @property Ssfield[] $ssfields
 * @property Svcourse[] $svcourses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Schedule extends Model
{
    use HasFactory;

    static $rules = [
		'id_hour' => 'required',
		'id_day' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_hour','id_day'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function day()
    {
        return $this->hasOne('App\Models\Day', 'id', 'id_day');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /**
     * public function hour()
        *{
    *    return $this->hasOne('App\Models\Hour', 'id', 'id_hour');
        *}
    */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssfields()
    {
        return $this->hasMany('App\Models\Ssfield', 'id_schedule', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function svcourses()
    {
        return $this->hasMany('App\Models\Svcourse', 'id_schedule', 'id');
    }


    public function daysAll(){
        $days= Day::all();
        return  $days;
    }
    public function getDayName(){
        $day=Day::where('id',$this->id_day)->first();
        return "$day->name";
    }
    public function gethour(){

        return "$this->startT : $this->finishT";
    }

}
