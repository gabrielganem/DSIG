<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
//use App\Models\Project;

class Sample extends Model
{
    protected $fillable = [
        'project_id',
        'date',
        'geom',
    ];

    public function project ()
    {
      return $this->belongsTo(Project::class);
    }

    public function fields ()
    {
      return $this->hasMany(Field::class);
    }
}
