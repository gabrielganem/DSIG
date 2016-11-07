<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
//use App\Models\Project;

class Institute extends Model
{
    protected $fillable = [
        'name',
        'abreviature',
        'geom',
    ];

    public function users ()
    {
      return $this->hasMany(User::class);
    }
}
