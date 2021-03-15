<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
  protected $fillable = [
      'name', 'email', 'phone', 'designation', 'short_name_desc', 'description', 'current_focus', 'professional_experience', 'course', 'image',
  ];
}
