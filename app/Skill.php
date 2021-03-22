<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attribute;

class Skill extends Model
{
    protected $fillable = [
      'title'
  ];

  public function attributes()
  {
  	return $this->hasMany(Attribute::class);
  }
}
