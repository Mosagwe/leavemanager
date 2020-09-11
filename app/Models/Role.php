<?php

namespace App\Models;

class Role extends BaseModel
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
