<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SField;
use App\Models\Ssfield;
use App\Models\Denizen;
/**
 * Class Lendsfiel
 *
 * @property $id
 * @property $id_scheduleSField
 * @property $id_user
 * @property $id_state
 * @property $dateLend
 * @property $created_at
 * @property $updated_at
 *
 * @property Ssfield $ssfield
 * @property State $state
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lendsfiel extends Model
{
    use HasFactory;

    static $rules = [
		'id_scheduleSField' => 'required',
		'id_user' => 'required',
		'id_state' => 'required',
		'dateLend' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_scheduleSField','id_user','id_state','dateLend'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ssfield()
    {
        return $this->hasOne('App\Models\Ssfield', 'id', 'id_scheduleSField');
    }

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
    public function getName(){
        $user=User::where('id',$this->id_user)->first();
        return "$user->firstName $user->lastName";
    }
    public function getSfield(){
        $sfield=SsField::where('id',$this->id_scheduleSField)->first();//busca el horario de prestamo
        $field=Sfield::where('id',$sfield->id_sField)->first();//trae la cancha
        return "$field->name";
    }

    public function getSsfield(){
        $sfield=SsField::where('id',$this->id_scheduleSField)->first();//busca el horario de prestamo
        return $sfield->getSchedule();
    }


}
