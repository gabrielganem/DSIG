<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
//use App\Models\Project;

class Sample extends Model
{
    protected $fillable = [
        'label_id',
        'project_id',
        'date',
    ];

    public function projects ()
    {
      return $this->belongsTo(Project::class);
    }
}
