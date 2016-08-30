<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
  protected $fillable = [
      'sample_id',
      'labels_id',
      'value',
  ];

  public function sample ()
  {
    return $this->belongsTo(Sample::class);
  }

  public function label ()
  {
    return $this->belongsTo(Label::class);
  }
}
