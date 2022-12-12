<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Activity;
use App\Models\Sector;

/**
 * Class SField
 *
 * @property $id
 * @property $name
 * @property $id_activity
 * @property $id_sector
 * @property $created_at
 * @property $updated_at
 *
 * @property Activity $activity
 * @property Sector $sector
 * @property Ssfield[] $ssfields
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SField extends Model
{
    use HasFactory;

    static $rules = [
		'name' => 'required',
		'id_activity' => 'required',
		'id_sector' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','id_activity','id_sector'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activity()
    {
        return $this->hasOne('App\Models\Activity', 'id', 'id_activity');
    }

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
    public function ssfields()
    {
        return $this->hasMany('App\Models\Ssfield', 'id_sField', 'id');
    }
    public function getSector(){
        $sector=Sector::where('id',$this->id_sector)->first();
        return $sector->getName();
    }
    public function getActivity(){
        $sector=Activity::where('id',$this->id_sector)->first();
        return $sector->getName();
    }
    public function getHours(){
        $sector=Schedule::where('id',$this->id_schedule)->first();
        return "$sector->hours";
    }

}
