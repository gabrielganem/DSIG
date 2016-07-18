<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Label extends Model
{
    protected $fillable = [
        'title',
        'unity',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}

