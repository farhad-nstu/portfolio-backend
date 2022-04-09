<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioMenuChild;

class PortfolioMenu extends Model
{
    public function childs()
  	{
  		return $this->hasMany(PortfolioMenuChild::class, 'menu_id', 'id');
  	}
}
