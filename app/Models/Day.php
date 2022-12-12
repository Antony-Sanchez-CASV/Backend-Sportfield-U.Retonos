<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Day
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property Schedule[] $schedules
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Day extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'id_day', 'id');
    }
    

}
