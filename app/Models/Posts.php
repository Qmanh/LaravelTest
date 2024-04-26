<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Posts extends Model
{
    use HasFactory;

    public function postCategories(): HasOne
    {
        return $this->hasOne(PostCategories::class);
    }
    public function getPostDescription()
    {

        return new HtmlString(Str::limit($this->description, 100));
    }


    protected $fillable = ['id','name','thumbImage','description','content','category_id','author_id','author_type'];
}
