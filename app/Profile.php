<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
//use App\Models\Project;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'geom',
    ];

    public function user ()
    {
      return $this->belongsTo(User::class);
    }

    public function institute ()
    {
      return $this->belongsTo(Institute::class);
    }
}
