<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_slug'
    ];

     /**
     * The posts that belong to the category.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_to_category', 'category_id', 'post_id');
    }
}
