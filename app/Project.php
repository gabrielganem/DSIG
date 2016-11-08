<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
//use App\Models\Label;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'institute',
        'department'
    ];

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function samples()
    {
      return $this->hasMany(Sample::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
