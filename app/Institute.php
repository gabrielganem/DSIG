<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
//use App\Models\Project;

class Institute extends Model
{
    protected $fillable = [
        'name',
        'geom',
    ];

    public function users ()
    {
      return $this->hasMany(Users::class);
    }
}
