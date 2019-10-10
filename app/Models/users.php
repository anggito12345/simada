<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class users
 * @package App\Models
 * @version September 3, 2019, 1:07 pm UTC
 *
 * @property string name
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 */
class users extends Model
{
    // use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'nip',
        'no_hp',
        'tgl_lahir',
        'jabatan',
        'jenis_kelamin',
        'username',
        'pid_organisasi',
        'aktif',
        'email_verification_code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string|unique',
        'username' => 'string|unique',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required|confirmed|min:6'
    ];


    public function setTglLahirAttribute($value)
    {
        $value = date("d-m-Y", strtotime($value));
        $this->attributes['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getTglLahirAttribute($value)
    {
        if ($value == "") {
            return "";
        }

        return date("d/m/Y", strtotime($value));
    }

    
}
