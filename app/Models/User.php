<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\GetCsvList;


/**
 * userのmodel
 *
 * @property bigint user_id   userId
 * @property string name      名前
 *
 */

class User extends Authenticatable
{
    use Notifiable,GetCsvList;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CSV_LIST = [
        'user_id',
        'name',
        'weight',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
