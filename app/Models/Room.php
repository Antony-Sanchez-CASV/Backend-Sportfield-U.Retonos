<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Room
 *
 * @property $id
 * @property $located
 * @property $id_sector
 * @property $created_at
 * @property $updated_at
 *
 * @property Sector $sector
 * @property Vcourse[] $vcourses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Room extends Model
{
    use HasFactory;

    static $rules = [
		'located' => 'required',
		'id_sector' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['located','id_sector'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sector()
    {
        return $this->hasOne('App\Models\Sector', 'id', 'id_sector');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vcourses()
    {
        return $this->hasMany('App\Models\Vcourse', 'id_room', 'id');
    }
    public function getLocated(){
        return "$this->located";
    }
    public function getSector(){
        $sector=Sector::where('id',$this->id_sector)->first();
        return $sector->getName();
    }



}
