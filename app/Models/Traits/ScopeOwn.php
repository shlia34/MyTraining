<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait ScopeOwn
{
    public function scopeOwn($query){
        return $query->where('user_id',Auth::user()->id);
    }
}

