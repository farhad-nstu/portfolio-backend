<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Skill;

class Attribute extends Model
{
    protected $fillable = [
      'skill_id', 'title', 'image',
  ];

  public function skill()
  {
  	return $this->belongsTo(Skill::class);
  }
}
