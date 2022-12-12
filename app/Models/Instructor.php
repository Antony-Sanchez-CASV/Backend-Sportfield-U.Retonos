<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 *
 * @property $id
 * @property $name
 * @property $latName
 * @property $collegeDegree
 * @property $salary
 * @property $address
 * @property $cellphone
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @property Vcourse[] $vcourses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Instructor extends Model
{

    use HasFactory;
    static $rules = [
		'name' => 'required',
		'latName' => 'required',
		'collegeDegree' => 'required',
		'salary' => 'required',
		'address' => 'required',
		'cellphone' => 'required',
		'email' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','latName','collegeDegree','salary','address','cellphone','email'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vcourses()
    {
        return $this->hasMany('App\Models\Vcourse', 'id_instructor', 'id');
    }
    //funciones
    public function getName(){
      return "$this->name $this->latName";
    }

    //$instructors->pluck('name','latname')
}
