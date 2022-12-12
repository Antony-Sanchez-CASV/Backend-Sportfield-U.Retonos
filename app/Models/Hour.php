<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hour
 *
 * @property $id
 * @property $startT
 * @property $finishT
 * @property $hours
 * @property $created_at
 * @property $updated_at
 *
 * @property Schedule[] $schedules
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Hour extends Model
{
    
    static $rules = [
		'startT' => 'required',
		'finishT' => 'required',
		'hours' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['startT','finishT','hours'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'id_hour', 'id');
    }
    //funciones
    public function getHour(){
      return "$this->startT : $this->finishT";
    }
    

}
