<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function runs()
    {
        return $this->hasMany('App\Run', 'user_id')->orderBy("run_date", "desc");
    }

    public function yearRuns()
    {
        return $this->hasMany('App\Run', 'user_id')->whereYear('run_date', '=', date("Y"));
    }
}
