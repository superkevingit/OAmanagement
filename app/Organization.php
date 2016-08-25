<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'owner_id', 'fid', 'organization_tag_id', 'confirmed'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_organization')->withTimestamps()->withPivot('identity');
    }
}
