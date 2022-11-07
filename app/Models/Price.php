<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Price extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasMany(Category::class,'category_id');
    }
}
