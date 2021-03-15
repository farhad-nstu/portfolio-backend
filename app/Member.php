<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'title', 'email', 'phone', 'designation', 'company_name', 'description', 'image',
    ];
}
