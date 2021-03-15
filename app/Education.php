<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
   protected $fillable = [
        'title', 'institute', 'concentration', 'pass_year', 'result',
    ];
}