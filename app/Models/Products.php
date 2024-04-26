<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Model
{
    use HasFactory;

    public function productCategories():HasOne
    {
        return $this->hasOne(ProductCategories::class);
    }
    protected $fillable = ['id','name','thumbImage','price','content','category_id','author_id','author_type'];
}
