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

}
