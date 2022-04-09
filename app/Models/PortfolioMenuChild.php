<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioMenu;

class PortfolioMenuChild extends Model
{
    public function menu()
  	{
  		return $this->belongsTo(PortfolioMenu::class, 'menu_id', 'id');
  	}
}
