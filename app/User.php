<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements
AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'student_id', 'password', 'confirmed'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public $oauth_client;

    public function organizations()
    {
        return $this->belongsToMany('App\Organization', 'user_organization')->withTimestamps()->withPivot('identity');
    }

    public function oauth_clients()
    {
        return $this->belongsToMany('App\OauthClient', 'user_oauth_client')->withTimestamps()->withPivot('confirmed');
    }

    public function apply_oauth_client(OauthClient $oauth_client)
    {
        $oauth_client->users()->save(\Auth::user());
    }
}
