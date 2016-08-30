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

  public function samples ()
  {
    return $this->belongsTo(Sample::class);
  }

  public function labels ()
  {
    return $this->belongsTo(Label::class);
  }
}
