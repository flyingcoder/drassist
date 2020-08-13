<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function records()
    {
        return $this->hasMany(MedRec::class);
    }

}
