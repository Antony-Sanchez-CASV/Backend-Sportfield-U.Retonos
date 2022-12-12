<?php

namespace App\Models;
use App\Models\Vcourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subsvcourse
 *
 * @property $id
 * @property $id_vcourse
 * @property $id_user
 * @property $id_state
 * @property $created_at
 * @property $updated_at
 *
 * @property State $state
 * @property User $user
 * @property Vcourse $vcourse
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subsvcourse extends Model
{
    use HasFactory;


    static $rules = [
		'id_vcourse' => 'required',
		'id_user' => 'required',
		'id_state' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_vcourse','id_user','id_state'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'id_state');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vcourse()
    {
        return $this->hasOne('App\Models\Vcourse', 'id', 'id_vcourse');
    }
    public function getNamecourse(){
        $course=Vcourse::where('id_vcourse',$this->id_vcourse)->first();
        return "$course->name";
    }
    public function getDescriptioncourse(){
        $course=Vcourse::where('id_vcourse',$this->id_vcourse)->first();
        return "$course->name";
    }
    public function getCapacitycourse(){
        $course=Vcourse::where('id_vcourse',$this->id_vcourse)->first();
        return "$course->name";
    }

}
